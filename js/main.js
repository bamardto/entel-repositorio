$(document).ready(function() {

   // TOOLS
   hideNew = true;
   $('body').on('click', function() {
      if (hideNew) $('.new-btn').removeClass('open');
      hideNew = true;
   });

   $('body').on('click', '.new-btn', function() {
      var selfNew = $('.new-btn');
      if (selfNew.hasClass('open')) {
         selfNew.removeClass('open');
         return false;
      }
      $('.new-btn').removeClass('open');

      selfNew.toggleClass('open');
      hideNew = false;
   });

   hideUpload = true;
   $('body').on('click', function() {
      if (hideUpload) $('.upload-btn').removeClass('open');
      hideUpload = true;
   });

   $('body').on('click', '.upload-btn', function() {
      var selfUpload = $('.upload-btn');
      if (selfUpload.hasClass('open')) {
         selfUpload.removeClass('open');
         return false;
      }
      $('.upload-btn').removeClass('open');

      selfUpload.toggleClass('open');
      hideUpload = false;
   });

   $('.file').click(function() {
      $('.upload-btn').removeClass('open');
   });
  

   $('.open-secondary').click(function() {
      $('.secondary').toggleClass('open');
      $(this).toggleClass('on');
   });



   // FILTER
   $('.filter select').each(function () {
      var $this = $(this),
         numberOfOptions = $(this).children('option').length;
   
      $this.addClass('select-hidden');
      $this.wrap('<div class="select"></div>');
      $this.after('<div class="select-styled"></div>');
   
      var $styledSelect = $this.next('div.select-styled');
      $styledSelect.text($this.children('option').eq(0).text());
   
      var $list = $('<ul />', {
         'class': 'select-options'
      }).insertAfter($styledSelect);
   
      for (var i = 0; i < numberOfOptions; i++) {
         $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
         }).appendTo($list);
         //if ($this.children('option').eq(i).is(':selected')){
         //  $('li[rel="' + $this.children('option').eq(i).val() + '"]').addClass('is-selected')
         //}
      }
   
      var $listItems = $list.children('li');
   
      $styledSelect.click(function (e) {
         e.stopPropagation();
         $('div.select-styled.active').not(this).each(function () {
            $(this).removeClass('active').next('ul.select-options').hide();
         });
         $(this).toggleClass('active').next('ul.select-options').toggle();
      });
   
      $listItems.click(function (e) {
         e.stopPropagation();
         $styledSelect.text($(this).text()).removeClass('active');
         $this.val($(this).attr('rel'));
         $list.hide();
         //console.log($this.val());
      });
   
      $(document).click(function () {
         $styledSelect.removeClass('active');
         $list.hide();
      });
      
   });



   // CHECKBOXES
   $(".select-all").click(function() {
      $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
   });
   
   $("input[type=checkbox]").click(function() {
      if (!$(this).prop("checked")) {
         $(".select-all").prop("checked", false);
      }
   });
   
   $('input[type=checkbox]').change(function() {
      if(this.checked) {
         $(this).parent().siblings().addClass('bg');
         $(this).parent().addClass('bg');
      } else {
         $(this).parent().siblings().removeClass('bg');
         $(this).parent().removeClass('bg');
      }
   });

   $('input[type=checkbox], input[type=radio]').click(function() {
      if($(this).prop("checked")) {
         $('.secondary li').removeClass('disabled');
      } else {
         $('.secondary li').addClass('disabled');
      }
   });



   // SEARCH
   var results =
   [
      {
         "label": "Corporaciones",
      },
      {
         "label": "Corporaciones entel internet",
      }
   ];

   $(function () {
      $('#search-box').autocompleter({
         highlightMatches: true,
         source: results,
         hint: true,
         empty: false
      });
   });

   $('.open-search').click(function() {
      $('.overlay').fadeIn();
      $('.search').css('display','flex');
   });
   $('.overlay').click(function() {
      $(this).fadeOut();
      $('.search').css('display','none');
   });



   // MODALS

   // VALIDACIÓN
   $(document).on('change keyup', '.required', function (e) {
      let Disabled = true;
      $(".required").each(function () {
         let value = this.value
         if ((value) && (value.trim() != '')) {
            Disabled = false
         } else {
            Disabled = true
            return false
         }
      });
      if (Disabled) {
         $('.toggle-disabled').prop("disabled", true);
      } else {
         $('.toggle-disabled').prop("disabled", false);
      }
   });

   $('.blur-overlay').click(function() {
      $('.blur-overlay').fadeOut();
      $('.modal').removeClass('show');
   });



   // NEW
   $('.new-btn ul li:first a').click(function() {
      $('.blur-overlay').fadeIn();
      $('.modal.folder').addClass('show');
   });
   $('.modal.folder button').click(function() {
      $('.blur-overlay').fadeOut();
      $('.modal.folder').removeClass('show');
   });

   // CREATE USER
   $('.btn-create-user a').click(function() {
      $('.blur-overlay').fadeIn();
      $('.modal.create-user').addClass('show');
   });
   $('.modal.create-user button').click(function() {
      $('.blur-overlay').fadeOut();
      $('.modal.create-user').removeClass('show');
   });

   // EDIT USER
   $('.btn-edit-user a').click(function() {
      if(!$(this).parent().hasClass('disabled')) {
         $('.blur-overlay').fadeIn();
         $('.modal.edit-user').addClass('show');
      }
   });
   $('.modal.edit-user button').click(function() {
      $('.blur-overlay').fadeOut();
      $('.modal.edit-user').removeClass('show');
   });

   // DELETE USER
   $('.btn-delete-user a').click(function() {
      if(!$(this).parent().hasClass('disabled')) {
         $('.blur-overlay').fadeIn();
         $('.modal.delete-user').addClass('show');
      }
   });
   $('.modal.delete-user a').click(function() {
      $('.blur-overlay').fadeOut();
      $('.modal.delete-user').removeClass('show');
   });




   // ACTIVE SIDEBAR
   $('.sidebar ul li a').click(function() {
      $('.sidebar ul li').removeClass('active');
      $(this).parent().addClass('active');
   });

});
function getSelectValue(){
   var selectedValue = document.getElementById("list").value;
   console.log(selectedValue);
}