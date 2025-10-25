<script>
let currentContentKey = null;
let currentContentType = null;

const COUNTDOWN_TARGET_KEY = 'home.countdown.target_datetime';
const OFFSET_PATTERN = /^[+-](0[0-9]|1[0-4]):[0-5][0-9]$/;

const textFieldsEl = document.getElementById('textFields');
const imageFieldsEl = document.getElementById('imageFields');
const datetimeFieldsEl = document.getElementById('datetimeFields');
const valueEnField = document.getElementById('valueEn');
const valueArField = document.getElementById('valueAr');
const datetimeInputEl = document.getElementById('valueDatetime');
const timezoneInputEl = document.getElementById('valueTimezone');
const isoPreviewEl = document.getElementById('valueIsoPreview');

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

function isoToDatetimeLocal(iso) {
    if (!iso) return '';
    const parsed = new Date(iso);
    if (Number.isNaN(parsed.getTime())) {
        return '';
    }
    const tzOffset = parsed.getTimezoneOffset();
    const local = new Date(parsed.getTime() - tzOffset * 60000);
    return local.toISOString().slice(0, 16);
}

function extractOffset(iso) {
    if (!iso || typeof iso !== 'string') {
        return '';
    }
    const match = iso.match(/([+-]\d{2}:\d{2}|Z)$/);
    if (!match) {
        return '';
    }
    return match[1] === 'Z' ? '+00:00' : match[1];
}

function formatOffsetFromMinutes(minutes) {
    if (!Number.isFinite(minutes)) {
        return '';
    }
    const sign = minutes >= 0 ? '+' : '-';
    const abs = Math.abs(minutes);
    const hours = String(Math.floor(abs / 60)).padStart(2, '0');
    const mins = String(abs % 60).padStart(2, '0');
    return `${sign}${hours}:${mins}`;
}

function deriveOffset(datetimeValue) {
    if (!datetimeValue) {
        return '';
    }
    const reference = new Date(datetimeValue);
    if (Number.isNaN(reference.getTime())) {
        return '';
    }
    return formatOffsetFromMinutes(-reference.getTimezoneOffset());
}

function updateIsoPreview(iso) {
    if (!isoPreviewEl) return;
    isoPreviewEl.textContent = iso && iso.trim() ? iso : '--';
}

function resetCountdownFields() {
    if (datetimeInputEl) {
        datetimeInputEl.value = '';
    }
    if (timezoneInputEl) {
        timezoneInputEl.value = '';
        timezoneInputEl.setCustomValidity('');
    }
    updateIsoPreview('--');
}

function getCountdownIso(requireValid = false) {
    if (!datetimeInputEl) {
        return requireValid ? null : '';
    }

    const datetimeValue = datetimeInputEl.value;
    if (!datetimeValue) {
        return requireValid ? null : '';
    }

    const parsed = new Date(datetimeValue);
    if (Number.isNaN(parsed.getTime())) {
        return requireValid ? null : '';
    }

    let offset = timezoneInputEl ? timezoneInputEl.value.trim() : '';
    if (offset) {
        if (!OFFSET_PATTERN.test(offset)) {
            return requireValid ? null : '';
        }
    } else {
        offset = deriveOffset(datetimeValue);
        if (offset && timezoneInputEl) {
            timezoneInputEl.value = offset;
        }
    }

    if (!offset || !OFFSET_PATTERN.test(offset)) {
        return requireValid ? null : '';
    }

    return `${datetimeValue}:00${offset}`;
}

function updateCountdownPreview() {
    if (currentContentKey !== COUNTDOWN_TARGET_KEY) {
        return;
    }

    const iso = getCountdownIso(false);
    updateIsoPreview(iso || '--');
    if (valueEnField) {
        valueEnField.value = iso || '';
    }
    if (valueArField) {
        valueArField.value = iso || '';
    }
}

function activateCountdownFields(initialIso, normalized) {
    if (!datetimeFieldsEl) {
        return;
    }

    datetimeFieldsEl.classList.remove('hidden');
    textFieldsEl?.classList.add('hidden');
    imageFieldsEl?.classList.add('hidden');

    const isoValue = typeof initialIso === 'string' ? initialIso : '';
    const localValue = isoToDatetimeLocal(isoValue);
    if (datetimeInputEl) {
        datetimeInputEl.value = localValue;
    }

    let offset = extractOffset(isoValue);
    if (!offset && localValue) {
        offset = deriveOffset(localValue);
    }

    if (timezoneInputEl) {
        timezoneInputEl.value = offset;
        timezoneInputEl.setCustomValidity('');
    }

    if (valueEnField) {
        valueEnField.value = isoValue;
    }
    if (valueArField) {
        const fallback = isoValue || '';
        valueArField.value = (normalized && normalized.ar) || fallback;
    }

    updateCountdownPreview();
}

function deactivateCountdownFields() {
    datetimeFieldsEl?.classList.add('hidden');
    textFieldsEl?.classList.remove('hidden');
    imageFieldsEl?.classList.add('hidden');
    resetCountdownFields();
}

if (datetimeInputEl) {
    datetimeInputEl.addEventListener('input', () => {
        if (currentContentKey !== COUNTDOWN_TARGET_KEY) {
            return;
        }

        if (timezoneInputEl && !timezoneInputEl.value) {
            const derived = deriveOffset(datetimeInputEl.value);
            if (derived) {
                timezoneInputEl.value = derived;
                timezoneInputEl.setCustomValidity('');
            }
        }

        updateCountdownPreview();
    });
}

if (timezoneInputEl) {
    timezoneInputEl.addEventListener('input', () => {
        if (currentContentKey !== COUNTDOWN_TARGET_KEY) {
            timezoneInputEl.setCustomValidity('');
            return;
        }

        const value = timezoneInputEl.value.trim();
        if (value && !OFFSET_PATTERN.test(value)) {
            timezoneInputEl.setCustomValidity('Offset must match ±HH:MM (maximum ±14:00).');
        } else {
            timezoneInputEl.setCustomValidity('');
        }

        updateCountdownPreview();
    });
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
        imageFieldsEl?.classList.add('hidden');

        const normalized = normalizeTranslations(currentValue);
        const isoCandidate = normalized.en ?? normalized.default ?? normalized.ar ?? '';

        if (contentKey === COUNTDOWN_TARGET_KEY) {
            activateCountdownFields(isoCandidate, normalized);
        } else {
            deactivateCountdownFields();
            textFieldsEl?.classList.remove('hidden');
            if (valueEnField) {
                valueEnField.value = normalized.en || '';
            }
            if (valueArField) {
                valueArField.value = normalized.ar || '';
            }
        }
    } else if (contentType === 'image') {
        // Show image fields, hide text fields
        deactivateCountdownFields();
        textFieldsEl?.classList.add('hidden');
        imageFieldsEl?.classList.remove('hidden');
        
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
            if (contentKey === COUNTDOWN_TARGET_KEY) {
                datetimeInputEl?.focus();
            } else {
                valueEnField?.focus();
            }
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
    deactivateCountdownFields();
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
            if (currentContentKey === COUNTDOWN_TARGET_KEY) {
                const isoValue = getCountdownIso(true);
                if (!isoValue) {
                    showErrorMessage('Please provide a valid date, time, and timezone offset.');
                    const offsetValue = timezoneInputEl ? timezoneInputEl.value.trim() : '';
                    if (!datetimeInputEl?.value) {
                        datetimeInputEl?.focus();
                    } else if (timezoneInputEl && !OFFSET_PATTERN.test(offsetValue)) {
                        timezoneInputEl.setCustomValidity('Offset must match ±HH:MM (maximum ±14:00).');
                        timezoneInputEl.reportValidity();
                    }
                    return;
                }
                timezoneInputEl?.setCustomValidity('');
                formData.append('value[en]', isoValue);
                formData.append('value[ar]', isoValue);
            } else {
                formData.append('value[en]', valueEnField?.value ?? '');
                formData.append('value[ar]', valueArField?.value ?? '');
            }
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

    if (key === COUNTDOWN_TARGET_KEY && currentContentKey === COUNTDOWN_TARGET_KEY && updateType === 'text') {
        const translations = normalizeTranslations(content);
        const isoValue = translations.en ?? translations.default ?? translations.ar ?? '';
        activateCountdownFields(isoValue, translations);
    }
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
