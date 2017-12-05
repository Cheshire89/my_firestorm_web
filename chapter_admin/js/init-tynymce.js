tinymce.init({
  selector: 'textarea',
  height: 350,
  statusbar: false,
  themes: "inlite",
  browser_spellcheck: true,
  // plugins: [
  //   'advlist autolink lists link image charmap print preview anchor',
  //   'searchreplace visualblocks code fullscreen',
  //   'insertdatetime media table contextmenu paste code'
  // ],
  toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
  custom_format:{block:'h1, h2, h3, h4, h5, h6', attributes: {class:'fs-header'}},
  custom_format:{block:'strong', attributes: {class:'fs-strong'}}
});