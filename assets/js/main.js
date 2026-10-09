/**
 * Main JavaScript Application - Apex Sports Club
 * Course: ISE 2102: Web Technologies
 * 
 * Features demonstrated:
 * - Variables (const, let) and strict equality operators
 * - Objects, Arrays, and iteration loops (forEach, filter, find)
 * - Event Listeners (click, submit, input, keydown, DOMContentLoaded)
 * - DOM Traversal & Manipulation
 * - Mobile Navigation Menu Toggle & ARIA states
 * - Interactive Multi-Sport Event Filtering & Empty States
 * - Interactive Photo Gallery Filtering
 * - Fullscreen Lightbox with Keyboard Navigation (Escape, Arrow keys)
 * - Comprehensive Client-side Form Validation & Accessible Alerts
 * - Dynamic Copyright Year Auto-Updater
 */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
    // 1. Dynamic Copyright Year
    initCopyrightYear();

    // 2. Mobile Navigation Toggle
    initMobileNav();

    // 3. Activities / Events Filtering
    initActivitiesFilter();

    // 4. Gallery Filtering & Accessible Lightbox
    initGalleryAndLightbox();

    // 5. Form Validation for Join Us / Contact
    initFormValidation();
});

/**
 * Update footer copyright year dynamically
 */
function initCopyrightYear() {
    const yearSpan = document.getElementById('copyright-year');
    if (yearSpan) {
        const currentYear = new Date().getFullYear();
        yearSpan.textContent = currentYear;
    }
}

/**
 * Mobile Navigation Menu Handler
 */
function initMobileNav() {
    const toggleBtn = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (!toggleBtn || !mobileMenu) return;

    toggleBtn.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.contains('open');
        if (isOpen) {
            mobileMenu.classList.remove('open');
            toggleBtn.classList.remove('active');
            toggleBtn.setAttribute('aria-expanded', 'false');
            mobileMenu.setAttribute('aria-hidden', 'true');
        } else {
            mobileMenu.classList.add('open');
            toggleBtn.classList.add('active');
            toggleBtn.setAttribute('aria-expanded', 'true');
            mobileMenu.setAttribute('aria-hidden', 'false');
        }
    });

    // Close mobile menu when clicking outside or clicking any link inside
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
            toggleBtn.classList.remove('active');
            toggleBtn.setAttribute('aria-expanded', 'false');
            mobileMenu.setAttribute('aria-hidden', 'true');
        });
    });
}

/**
 * Filter activities and events by sport category
 */
function initActivitiesFilter() {
    const filterButtons = document.querySelectorAll('.filter-bar .filter-btn:not(.gallery-filter-btn)');
    const eventCards = document.querySelectorAll('#events-container .event-card');
    const emptyState = document.getElementById('events-empty-state');
    const resetBtn = document.getElementById('reset-filter-btn');

    if (!filterButtons.length || !eventCards.length) return;

    // Check for URL query param, e.g. ?filter=football
    const urlParams = new URLSearchParams(window.location.search);
    const initialCategory = urlParams.get('category') || urlParams.get('filter');

    // Filter logic function
    function applyFilter(targetCategory) {
        let matchCount = 0;
        const normalizedTarget = targetCategory.toLowerCase();

        eventCards.forEach(card => {
            const cardCategory = (card.getAttribute('data-category') || '').toLowerCase();
            const shouldShow = (normalizedTarget === 'all' || cardCategory.includes(normalizedTarget));

            if (shouldShow) {
                card.style.display = 'flex';
                matchCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update active class on filter buttons
        filterButtons.forEach(btn => {
            const btnFilter = btn.getAttribute('data-filter').toLowerCase();
            const isMatch = (btnFilter === normalizedTarget);
            btn.classList.toggle('active', isMatch);
            btn.setAttribute('aria-selected', isMatch ? 'true' : 'false');
        });

        // Handle empty state visibility
        if (emptyState) {
            emptyState.style.display = (matchCount === 0) ? 'block' : 'none';
        }
    }

    // Attach click listeners to filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const category = button.getAttribute('data-filter');
            applyFilter(category);
        });
    });

    // Reset button inside empty state
    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            applyFilter('all');
        });
    }

    // Auto-apply if parameter was passed
    if (initialCategory) {
        applyFilter(initialCategory);
    }
}

/**
 * Gallery Image Filtering & Lightbox Modal System
 */
function initGalleryAndLightbox() {
    const galleryItems = document.querySelectorAll('#gallery-container .gallery-item');
    const galleryFilters = document.querySelectorAll('.gallery-filter-btn');
    const emptyState = document.getElementById('gallery-empty-state');
    const resetBtn = document.getElementById('reset-gallery-filter-btn');

    const modal = document.getElementById('lightbox-modal');
    const modalImg = document.getElementById('lightbox-img');
    const modalTitle = document.getElementById('lightbox-title');
    const modalCategory = document.getElementById('lightbox-category');
    const modalDesc = document.getElementById('lightbox-desc');
    const closeBtn = document.getElementById('lightbox-close');
    const prevBtn = document.getElementById('lightbox-prev');
    const nextBtn = document.getElementById('lightbox-next');

    if (!galleryItems.length || !modal) return;

    // Use embedded gallery items array or fallback
    const itemsData = window.APEX_GALLERY_DATA || [];
    let currentFilteredIndices = [];
    let currentActiveIndex = 0;

    // Helper: update list of currently visible gallery card indexes
    function refreshVisibleIndices() {
        currentFilteredIndices = [];
        galleryItems.forEach((item, index) => {
            if (item.style.display !== 'none') {
                currentFilteredIndices.push(index);
            }
        });
    }
    refreshVisibleIndices();

    // Gallery Category Filter
    function filterGallery(category) {
        const normalized = category.toLowerCase();
        let visibleCount = 0;

        galleryItems.forEach(item => {
            const itemCat = (item.getAttribute('data-category') || '').toLowerCase();
            const matches = (normalized === 'all' || itemCat === normalized);

            if (matches) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        galleryFilters.forEach(btn => {
            const btnFilter = btn.getAttribute('data-filter').toLowerCase();
            const isActive = (btnFilter === normalized);
            btn.classList.toggle('active', isActive);
            btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        if (emptyState) {
            emptyState.style.display = (visibleCount === 0) ? 'block' : 'none';
        }

        refreshVisibleIndices();
    }

    galleryFilters.forEach(btn => {
        btn.addEventListener('click', () => {
            const filterCat = btn.getAttribute('data-filter');
            filterGallery(filterCat);
        });
    });

    if (resetBtn) {
        resetBtn.addEventListener('click', () => filterGallery('all'));
    }

    // Lightbox modal opener
    function openLightbox(dataIndex) {
        const itemObj = itemsData[dataIndex];
        if (!itemObj) return;

        currentActiveIndex = currentFilteredIndices.indexOf(dataIndex);
        if (currentActiveIndex === -1) currentActiveIndex = 0;

        modalImg.src = itemObj.src;
        modalImg.alt = itemObj.alt;
        modalTitle.textContent = itemObj.title;
        modalCategory.textContent = itemObj.category;
        modalDesc.textContent = itemObj.caption;

        modal.style.display = 'flex';
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scroll
        closeBtn.focus();
    }

    function closeLightbox() {
        modal.classList.remove('active');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    function showNextImage() {
        if (!currentFilteredIndices.length) return;
        currentActiveIndex = (currentActiveIndex + 1) % currentFilteredIndices.length;
        const targetIndex = currentFilteredIndices[currentActiveIndex];
        openLightbox(targetIndex);
    }

    function showPrevImage() {
        if (!currentFilteredIndices.length) return;
        currentActiveIndex = (currentActiveIndex - 1 + currentFilteredIndices.length) % currentFilteredIndices.length;
        const targetIndex = currentFilteredIndices[currentActiveIndex];
        openLightbox(targetIndex);
    }

    // Attach click and keyboard events to gallery cards
    galleryItems.forEach(item => {
        const dataIndex = parseInt(item.getAttribute('data-index'), 10);

        item.addEventListener('click', () => openLightbox(dataIndex));

        // Keyboard Enter or Space key support
        item.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openLightbox(dataIndex);
            }
        });
    });

    // Lightbox controls
    if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
    if (nextBtn) nextBtn.addEventListener('click', showNextImage);
    if (prevBtn) prevBtn.addEventListener('click', showPrevImage);

    // Close when clicking modal backdrop outside content
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeLightbox();
        }
    });

    // Keyboard navigation (Escape, Left Arrow, Right Arrow)
    document.addEventListener('keydown', (e) => {
        if (!modal.classList.contains('active')) return;

        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowRight') {
            showNextImage();
        } else if (e.key === 'ArrowLeft') {
            showPrevImage();
        }
    });
}

/**
 * Client-Side Form Validation for Membership Form
 */
function initFormValidation() {
    const form = document.getElementById('membership-form');
    if (!form) return;

    const fullNameInput = document.getElementById('full_name');
    const emailInput = document.getElementById('email');
    const courseInput = document.getElementById('course');
    const studyYearSelect = document.getElementById('study_year');
    const preferredActivitySelect = document.getElementById('preferred_activity');
    const consentCheckbox = document.getElementById('consent');
    const reasonTextarea = document.getElementById('reason');

    const statusAlert = document.getElementById('form-status-alert');
    const errorsList = document.getElementById('form-errors-list');

    // Email regex validation pattern
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Helper: display error for a specific field
    function setFieldError(field, errorId, isValid) {
        const errorElement = document.getElementById(errorId);
        if (!isValid) {
            field.classList.add('is-invalid');
            if (errorElement) errorElement.classList.add('visible');
        } else {
            field.classList.remove('is-invalid');
            if (errorElement) errorElement.classList.remove('visible');
        }
    }

    // Real-time input listeners to clear errors on change
    if (fullNameInput) {
        fullNameInput.addEventListener('input', () => {
            const valid = fullNameInput.value.trim().length >= 2;
            setFieldError(fullNameInput, 'error-full_name', valid);
        });
    }

    if (emailInput) {
        emailInput.addEventListener('input', () => {
            const valid = emailPattern.test(emailInput.value.trim());
            setFieldError(emailInput, 'error-email', valid);
        });
    }

    if (courseInput) {
        courseInput.addEventListener('input', () => {
            const valid = courseInput.value.trim().length >= 2;
            setFieldError(courseInput, 'error-course', valid);
        });
    }

    if (studyYearSelect) {
        studyYearSelect.addEventListener('change', () => {
            setFieldError(studyYearSelect, 'error-study_year', studyYearSelect.value !== '');
        });
    }

    if (preferredActivitySelect) {
        preferredActivitySelect.addEventListener('change', () => {
            setFieldError(preferredActivitySelect, 'error-preferred_activity', preferredActivitySelect.value !== '');
        });
    }

    if (consentCheckbox) {
        consentCheckbox.addEventListener('change', () => {
            setFieldError(consentCheckbox, 'error-consent', consentCheckbox.checked);
        });
    }

    // Form submission validation handler
    form.addEventListener('submit', (event) => {
        let isFormValid = true;
        const validationErrors = [];

        // 1. Full Name
        const nameVal = fullNameInput.value.trim();
        if (nameVal.length < 2) {
            setFieldError(fullNameInput, 'error-full_name', false);
            validationErrors.push('Full name must be at least 2 characters long.');
            isFormValid = false;
        } else {
            setFieldError(fullNameInput, 'error-full_name', true);
        }

        // 2. Email Address
        const emailVal = emailInput.value.trim();
        if (!emailPattern.test(emailVal)) {
            setFieldError(emailInput, 'error-email', false);
            validationErrors.push('A valid student email address is required.');
            isFormValid = false;
        } else {
            setFieldError(emailInput, 'error-email', true);
        }

        // 3. Course / Department
        const courseVal = courseInput.value.trim();
        if (courseVal.length < 2) {
            setFieldError(courseInput, 'error-course', false);
            validationErrors.push('Course or department cannot be left blank.');
            isFormValid = false;
        } else {
            setFieldError(courseInput, 'error-course', true);
        }

        // 4. Study Year
        if (!studyYearSelect.value) {
            setFieldError(studyYearSelect, 'error-study_year', false);
            validationErrors.push('Please select your current year of study.');
            isFormValid = false;
        } else {
            setFieldError(studyYearSelect, 'error-study_year', true);
        }

        // 5. Preferred Activity
        if (!preferredActivitySelect.value) {
            setFieldError(preferredActivitySelect, 'error-preferred_activity', false);
            validationErrors.push('Please select a preferred sport or activity.');
            isFormValid = false;
        } else {
            setFieldError(preferredActivitySelect, 'error-preferred_activity', true);
        }

        // 6. Reason character limit check
        if (reasonTextarea && reasonTextarea.value.length > 600) {
            setFieldError(reasonTextarea, 'error-reason', false);
            validationErrors.push('Reason for joining must be 600 characters or fewer.');
            isFormValid = false;
        } else if (reasonTextarea) {
            setFieldError(reasonTextarea, 'error-reason', true);
        }

        // 7. Consent Checkbox
        if (!consentCheckbox.checked) {
            setFieldError(consentCheckbox, 'error-consent', false);
            validationErrors.push('Consent agreement must be checked to submit.');
            isFormValid = false;
        } else {
            setFieldError(consentCheckbox, 'error-consent', true);
        }

        // Handle validation results
        if (!isFormValid) {
            event.preventDefault(); // Stop submission

            // Populate accessible error summary list
            if (statusAlert && errorsList) {
                errorsList.innerHTML = '';
                validationErrors.forEach(msg => {
                    const li = document.createElement('li');
                    li.textContent = msg;
                    errorsList.appendChild(li);
                });
                statusAlert.style.display = 'block';
                statusAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        } else {
            if (statusAlert) statusAlert.style.display = 'none';
            // Allow native form POST to process.php
        }
    });
}
