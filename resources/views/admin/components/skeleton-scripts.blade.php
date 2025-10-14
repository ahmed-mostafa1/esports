<script>
let currentContentKey = null;
let currentContentType = null;

// Open modal for editing content
function openModal(contentKey, contentType, currentValue, imageUrl = null) {
    currentContentKey = contentKey;
    currentContentType = contentType;
    
    // Set modal title and key
    document.getElementById('modalTitle').textContent = `Edit ${contentType} content`;
    document.getElementById('modalKey').textContent = contentKey;
    document.getElementById('contentType').textContent = contentType;
    
    // Clear previous error/success messages
    hideMessage();
    
    if (contentType === 'text') {
        // Show text fields, hide image fields
        document.getElementById('textFields').classList.remove('hidden');
        document.getElementById('imageFields').classList.add('hidden');
        
        // Populate current values
        if (currentValue && typeof currentValue === 'object') {
            document.getElementById('valueEn').value = currentValue.en || '';
            document.getElementById('valueAr').value = currentValue.ar || '';
        } else {
            document.getElementById('valueEn').value = currentValue || '';
            document.getElementById('valueAr').value = '';
        }
    } else if (contentType === 'image') {
        // Show image fields, hide text fields
        document.getElementById('textFields').classList.add('hidden');
        document.getElementById('imageFields').classList.remove('hidden');
        
        // Set expected filename
        const expectedFilename = contentKey + '.png';
        document.getElementById('expectedFilename').textContent = expectedFilename;
        
        // Show current image if exists
        if (imageUrl) {
            document.getElementById('currentImagePreview').classList.remove('hidden');
            document.getElementById('currentImage').src = imageUrl;
        } else {
            document.getElementById('currentImagePreview').classList.add('hidden');
        }
        
        // Clear file input
        document.getElementById('imageFile').value = '';
    }
    
    // Show modal
    document.getElementById('contentModal').classList.remove('hidden');
    document.getElementById('contentModal').classList.add('flex');
    
    // Focus first input
    setTimeout(() => {
        if (contentType === 'text') {
            document.getElementById('valueEn').focus();
        } else {
            document.getElementById('imageFile').focus();
        }
    }, 100);
}

// Close modal
function closeModal() {
    document.getElementById('contentModal').classList.add('hidden');
    document.getElementById('contentModal').classList.remove('flex');
    currentContentKey = null;
    currentContentType = null;
}

// Save content via AJAX
async function saveContent() {
    if (!currentContentKey) return;
    
    const saveButton = document.getElementById('saveButton');
    const saveButtonText = document.getElementById('saveButtonText');
    const saveButtonSpinner = document.getElementById('saveButtonSpinner');
    
    // Show loading state
    saveButton.disabled = true;
    saveButtonText.textContent = 'Saving...';
    saveButtonSpinner.classList.remove('hidden');
    
    try {
        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        if (currentContentType === 'text') {
            formData.append('value[en]', document.getElementById('valueEn').value);
            formData.append('value[ar]', document.getElementById('valueAr').value);
        } else if (currentContentType === 'image') {
            const fileInput = document.getElementById('imageFile');
            if (fileInput.files.length > 0) {
                formData.append('image', fileInput.files[0]);
            }
        }
        
        const response = await fetch(`/admin/contents/${currentContentKey}/ajax`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            showSuccessMessage(result.message);
            
            // Update the content in the skeleton view
            updateSkeletonContent(currentContentKey, result.content, result.imageUrl);
            
            // Close modal after short delay
            setTimeout(() => {
                closeModal();
            }, 1500);
        } else {
            showErrorMessage(result.message || 'An error occurred while saving');
        }
        
    } catch (error) {
        console.error('Error saving content:', error);
        showErrorMessage('Network error occurred. Please try again.');
    } finally {
        // Reset button state
        saveButton.disabled = false;
        saveButtonText.textContent = 'Save Changes';
        saveButtonSpinner.classList.add('hidden');
    }
}

// Update content in skeleton view
function updateSkeletonContent(key, content, imageUrl = null) {
    const contentElements = document.querySelectorAll(`[data-content-key="${key}"]`);
    
    contentElements.forEach(element => {
        if (currentContentType === 'text') {
            // Update text content (prefer current locale or fallback to English)
            const currentLocale = document.documentElement.lang || 'en';
            const textValue = content[currentLocale] || content.en || content;
            element.textContent = textValue;
        } else if (currentContentType === 'image' && imageUrl) {
            // Update image src
            if (element.tagName === 'IMG') {
                element.src = imageUrl;
            }
        }
        
        // Add visual feedback that content was updated
        element.classList.add('content-updated');
        setTimeout(() => {
            element.classList.remove('content-updated');
        }, 2000);
    });
}

// Show error message
function showErrorMessage(message) {
    hideMessage();
    document.getElementById('errorMessage').textContent = message;
    document.getElementById('errorDisplay').classList.remove('hidden');
}

// Show success message
function showSuccessMessage(message) {
    hideMessage();
    document.getElementById('successMessage').textContent = message;
    document.getElementById('successDisplay').classList.remove('hidden');
}

// Hide all messages
function hideMessage() {
    document.getElementById('errorDisplay').classList.add('hidden');
    document.getElementById('successDisplay').classList.add('hidden');
}

// Close modal on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && !document.getElementById('contentModal').classList.contains('hidden')) {
        closeModal();
    }
});

// Close modal when clicking outside
document.getElementById('contentModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal();
    }
});

// Handle content node clicks
document.addEventListener('click', function(event) {
    const contentNode = event.target.closest('[data-content-key]');
    if (contentNode) {
        event.preventDefault();
        
        const key = contentNode.getAttribute('data-content-key');
        const type = contentNode.getAttribute('data-content-type');
        const currentValue = contentNode.getAttribute('data-content-value');
        const imageUrl = contentNode.getAttribute('data-image-url');
        
        // Parse current value if it's JSON
        let parsedValue = currentValue;
        try {
            if (currentValue && currentValue.startsWith('{')) {
                parsedValue = JSON.parse(currentValue);
            }
        } catch (e) {
            // Keep as string if not valid JSON
        }
        
        openModal(key, type, parsedValue, imageUrl);
    }
});
</script>