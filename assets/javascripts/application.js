$(document).ready(function() {
  questionnaire.initialize();
});

var questionnaire = {
  initialize: function() {
    questionnaire.initializeSlides();
    questionnaire.initializeEmploymentHistory();
  },
  initializeSlides: function() {
    $('.slide .button.continue').on('click', function() {
      $('.slide.current').toggleClass('current hidden').next('.slide').toggleClass('current hidden');
      $('aside li.current').removeClass('current').next('li').addClass('current visited');
    });
    $('.slide .button.back').on('click', function() {
      $('.slide.current').toggleClass('current hidden').prev('.slide').toggleClass('current hidden');
      $('aside li.current').removeClass('current').prev('li').addClass('current');
    });
  },
  initializeEmploymentHistory: function() {
    $('input[type="radio"][data-behavior="toggle-self-employed"]').on('change', function() {
      $(this).closest('.job-form').find('.field[data-field="business-name"], .field[data-field="employer"]').toggleClass('hidden');
    });

    $('input[type="radio"][data-behavior="toggle-first-job"]').on('change', function() {
      if ($(this).val() == 'yes') {
        $('.job-form[data-job-form="first-job"], .field[data-field="another-job"]').addClass('hidden');
        $('.job-form[data-job-form="other-job"]').remove();
      } else {
        $('.job-form[data-job-form="first-job"], .field[data-field="another-job"]').removeClass('hidden');
      }
    });

    $('input[type="radio"][data-behavior="add-another-job"]').on('change', function() {
      if ($(this).val() == 'yes') {
        questionnaire.addAnotherJob();
      }
    });
  },
  addAnotherJob: function() {
    var newJobForm = $('.job-form[data-job-form="first-job"]').clone();
    newJobForm.data('job-form', 'other-job');
    newJobForm.find('span').text('Other Job Information');
    newJobForm.find('input[type="text"], textarea').val('');
    newJobForm.find('select option').first().prop('selected');
    newJobForm.find('input[type="radio"]').prop('checked', false);
    newJobForm.find('input[type="radio"][data-behavior="toggle-self-employed"]').last().prop('checked', true);
    newJobForm.find('input[type="radio"][data-behavior="toggle-self-employed"]').each(function() {
      var id = $(this).attr('id');
      var newId = id.substring(0, 5) + $('.job-form').length + id.substring(6);
      $(this).attr('id', newId);
      $(this).next('label').attr('for', newId);
    });
    newJobForm.find('input[type="text"], input[type="radio"], select, textarea').each(function() {
      var name = $(this).attr('name');
      var newName = name.substring(0, 5) + $('.job-form').length + name.substring(6);
      $(this).attr('name', newName);
    });
    $('input[type="radio"][data-behavior="add-another-job"]').prop('checked', false);
    $('.slide.current .field[data-field="another-job"]').before(newJobForm);
  }
};