tinymce.init({
    selector: 'textarea',
    menubar: true,
    entity_encoding : "raw",
    style_formats:
    [
      { title: 'Titre 1', format: 'h1' },
      { title: 'Titre 2', format: 'h2' },
      { title: 'Titre 3', format: 'h3' }
    ],
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table directionality emoticons template paste'
    ],
    language: 'fr_FR',
    language_url : 'public/js/fr_FR.js',
    toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify  |  numlist bullist checklist | forecolor casechange | emoticons | fullscreen  preview | showcomments addcomment',
    browser_spellcheck: true, // correcteur orthographe du navigateur
    spellchecker_languages: 'French=fr_FR',
    height : 500
  });