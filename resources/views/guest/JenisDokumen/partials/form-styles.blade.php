<style>
.document-form-card {
    background-color: #fff;
    border-radius: 28px;
    padding: 40px 48px;
    box-shadow: 0 25px 60px rgba(15, 23, 42, 0.08);
}

.document-form-card__header {
    background: linear-gradient(120deg, rgba(83, 123, 255, 0.12), rgba(0, 210, 190, 0.12));
    border-radius: 18px;
    padding: 18px 22px;
    margin-bottom: 28px;
    font-size: 15px;
    color: #4f566b;
}

.document-form-card__body .single-input + .single-input {
    margin-top: 24px;
}

.document-form-card label {
    font-weight: 600;
    color: #1f2a37;
    margin-bottom: 10px;
    display: inline-block;
}

.document-form-card .input-with-icon {
    position: relative;
    display: flex;
    align-items: center;
    background: #f7f9fc;
    border-radius: 16px;
    padding: 0 18px;
    border: 1px solid transparent;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.document-form-card .input-with-icon textarea,
.document-form-card .input-with-icon input {
    border: none;
    background: transparent;
    box-shadow: none;
    padding-left: 12px;
    width: 100%;
}

.document-form-card .input-with-icon textarea:focus,
.document-form-card .input-with-icon input:focus {
    outline: none;
}

.document-form-card .input-with-icon i {
    color: #5f6b84;
    font-size: 20px;
}

.document-form-card .input-with-icon:focus-within {
    border-color: rgba(83, 123, 255, 0.65);
    box-shadow: 0 10px 30px rgba(83, 123, 255, 0.12);
    background: #fff;
}

.document-form-card .input-with-icon.textarea {
    padding-top: 14px;
    align-items: flex-start;
}

.document-form-card textarea.form-input {
    min-height: 160px;
    resize: vertical;
}

.media-upload {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: center;
}

.media-preview {
    width: 170px;
    height: 170px;
    border: 1px dashed #bfc8e6;
    border-radius: 20px;
    background: #f3f6fd;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.media-preview__placeholder {
    color: #6c789b;
    text-align: center;
    font-weight: 500;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}

.media-preview__placeholder i {
    font-size: 26px;
}

.media-preview__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.upload-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.upload-button {
    background: #fff;
    border: 1px solid #d7def1;
    color: #1f2a37;
    border-radius: 14px;
    padding: 10px 18px;
    display: inline-flex;
    gap: 8px;
    align-items: center;
    cursor: pointer;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.upload-button:hover {
    border-color: rgba(83, 123, 255, 0.65);
    box-shadow: 0 10px 30px rgba(83, 123, 255, 0.12);
}

.upload-hint {
    font-size: 13px;
    color: #6c789b;
}

.document-form-card__actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    margin-top: 32px;
}

.document-form-card__actions .button {
    border: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
}

.document-form-card__actions .primary-action {
    background: linear-gradient(120deg, #437ff5, #00d2be);
    color: #fff;
}

.document-form-card__actions .secondary-action {
    background: #e8ecf5;
    color: #1f2a37;
}

.document-form-card__actions .secondary-action:hover {
    background: #dfe5f2;
}

@media (max-width: 767px) {
    .document-form-card {
        padding: 30px 22px;
    }

    .document-form-card__actions {
        flex-direction: column;
    }

    .document-form-card__actions .button {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('foto');
    const preview = document.getElementById('fotoPreview');

    if (!fileInput || !preview) {
        return;
    }

    const placeholder = preview.querySelector('.media-preview__placeholder');
    const imageEl = preview.querySelector('.media-preview__img');
    const defaultImage = preview.dataset.defaultImage || '';

    const showPlaceholder = () => {
        if (imageEl) {
            imageEl.src = '';
            imageEl.classList.add('d-none');
        }
        if (defaultImage) {
            imageEl.src = defaultImage;
            imageEl.classList.remove('d-none');
            placeholder?.classList.add('d-none');
            return;
        }
        placeholder?.classList.remove('d-none');
    };

    const showImage = (url) => {
        if (!imageEl) return;
        imageEl.src = url;
        imageEl.classList.remove('d-none');
        placeholder?.classList.add('d-none');
    };

    if (defaultImage) {
        showImage(defaultImage);
    }

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files && event.target.files[0];
        if (!file || !file.type.startsWith('image/')) {
            showPlaceholder();
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            if (!e.target?.result) {
                showPlaceholder();
                return;
            }
            showImage(e.target.result);
        };
        reader.readAsDataURL(file);
    });
});
</script>

