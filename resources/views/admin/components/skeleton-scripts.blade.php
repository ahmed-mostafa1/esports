<script>
let currentContentKey = null;
let currentContentType = null;

function normalizeTranslations(payload) {
    if (!payload) return {};
    if (typeof payload === 'string') {
        return { en: payload };
    }
    if (typeof payload === 'object') {
        return payload;
    }
    return {};
}

function normalizeImagePayload(payload) {
    if (payload && typeof payload === 'object') {
        return payload;
    }
    if (typeof payload === 'string') {
        return { path: payload };
    }
    return {};
}

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
        const normalized = normalizeTranslations(currentValue);
        document.getElementById('valueEn').value = normalized.en || '';
        document.getElementById('valueAr').value = normalized.ar || '';
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
            updateSkeletonContent(currentContentKey, result.content, result.imageUrl, currentContentType);
            
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
function updateSkeletonContent(key, content, imageUrl = null, specifiedType = null) {
    const contentElements = document.querySelectorAll(`[data-content-key="${key}"]`);
    
    const updateType = specifiedType || currentContentType;

    contentElements.forEach(element => {
        if (updateType === 'text') {
            const translations = normalizeTranslations(content);
            const currentLocale = document.documentElement.lang || 'en';
            const textValue = translations[currentLocale] ?? translations.en ?? translations.default ?? '';
            element.textContent = textValue;
            const serialised = JSON.stringify(translations);
            element.setAttribute('data-content-value', serialised);
            element.dataset.contentValue = serialised;
        } else if (updateType === 'image' && imageUrl) {
            const payload = normalizeImagePayload(content);
            const serialised = JSON.stringify(payload);
            element.setAttribute('data-content-value', serialised);
            element.dataset.contentValue = serialised;
            element.setAttribute('data-image-url', imageUrl);
            element.dataset.imageUrl = imageUrl;

            if (element.tagName === 'IMG') {
                element.src = imageUrl;
            } else {
                const img = element.querySelector('img');
                if (img) {
                    img.src = imageUrl;
                }
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
document.addEventListener('click', async function(event) {
    const contentNode = event.target.closest('[data-content-key]');
    if (!contentNode) {
        return;
    }

    event.preventDefault();
        
    const key = contentNode.getAttribute('data-content-key');
    const type = contentNode.getAttribute('data-content-type');
    const currentValue = contentNode.getAttribute('data-content-value');
    const imageUrl = contentNode.getAttribute('data-image-url');
    
    // Parse current value if it's JSON
    let parsedValue = currentValue;
    try {
        if (currentValue && currentValue.trim().startsWith('{')) {
            parsedValue = JSON.parse(currentValue);
        }
    } catch (e) {
        parsedValue = currentValue;
    }

    let fetchedValue = parsedValue;
    let fetchedImageUrl = imageUrl;

    try {
        const response = await fetch(`/admin/contents/${encodeURIComponent(key)}/data`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (response.ok) {
            const data = await response.json();
            if (data && data.success) {
                fetchedValue = data.content ?? fetchedValue;
                if (data.imageUrl) {
                    fetchedImageUrl = data.imageUrl;
                }
            }
        }
    } catch (error) {
        console.warn('Failed to fetch content data for', key, error);
    }
    
    openModal(key, type, fetchedValue, fetchedImageUrl);
});
</script>
