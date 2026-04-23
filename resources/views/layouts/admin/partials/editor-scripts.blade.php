<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ckeditor5@42.0.0/dist/browser/ckeditor5.css">
<script src="https://cdn.jsdelivr.net/npm/ckeditor5@42.0.0/dist/browser/ckeditor5.umd.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const {
        ClassicEditor,
        Autoformat,
        Bold, Italic, Underline, Code,
        BlockQuote,
        CodeBlock,
        Essentials,
        Heading,
        Image, ImageCaption, ImageStyle, ImageToolbar, ImageUpload, ImageResize,
        Indent, IndentBlock,
        Link,
        List,
        Paragraph,
        SimpleUploadAdapter,
        Table, TableToolbar,
        HorizontalLine,
    } = ckeditor5;

    const uploadConfig = {
        uploadUrl: '{{ route('admin.upload-image') }}',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    };

    const fullConfig = {
        plugins: [
            Essentials, Autoformat, Paragraph, Heading,
            Bold, Italic, Underline, Code,
            BlockQuote, HorizontalLine,
            CodeBlock,
            Link,
            List, Indent, IndentBlock,
            Image, ImageCaption, ImageStyle, ImageToolbar, ImageUpload, ImageResize,
            SimpleUploadAdapter,
            Table, TableToolbar,
        ],
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'underline', 'code', '|',
                'link', 'blockQuote', 'horizontalLine', '|',
                'bulletedList', 'numberedList', 'indent', 'outdent', '|',
                'insertImage', 'insertTable', '|',
                'codeBlock', '|',
                'undo', 'redo',
            ]
        },
        image: {
            toolbar: ['imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|', 'imageTextAlternative'],
        },
        codeBlock: {
            languages: [
                { language: 'plaintext', label: 'Plain text' },
                { language: 'javascript', label: 'JavaScript' },
                { language: 'typescript', label: 'TypeScript' },
                { language: 'php', label: 'PHP' },
                { language: 'python', label: 'Python' },
                { language: 'css', label: 'CSS' },
                { language: 'html', label: 'HTML' },
                { language: 'bash', label: 'Bash' },
                { language: 'sql', label: 'SQL' },
                { language: 'json', label: 'JSON' },
            ]
        },
        simpleUpload: uploadConfig,
    };

    ClassicEditor.create(document.querySelector('#editor-excerpt'), {
        plugins: [Essentials, Paragraph, Bold, Italic, Link],
        toolbar: { items: ['bold', 'italic', 'link', '|', 'undo', 'redo'] },
        simpleUpload: uploadConfig,
    })
    .then(editor => { editor.ui.view.editable.element.style.minHeight = '80px'; })
    .catch(console.error);

    ClassicEditor.create(document.querySelector('#editor-content'), fullConfig)
        .then(editor => { editor.ui.view.editable.element.style.minHeight = '350px'; })
        .catch(console.error);
});
</script>
