$(document).ready(function () {
   $('.viewhere').click(function (e) {
       e.preventDefault();
       let src=$(this).attr('href');
       $('.modal .modal-body').html('<iframe src="'+src+'"></iframe>');
       $('.modal').modal('show');

   })
});
