$(document).ready(function() {
  $('input[data-behavior="generate-pdf"]').on('click', function() {
    var html = document.querySelector('html').outerHTML;
    var form = $(this).siblings('form');
    form.find('input[type="hidden"][name="html"]').val(html);
    form.submit();
  });
});