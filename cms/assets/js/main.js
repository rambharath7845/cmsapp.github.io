window.addEventListener('DOMContentLoaded', event => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});



$(document).ready(function () {
    $('#example').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": false,
    });
});


function toggleMenu(id){  

  if($('#'+id).attr('aria-expanded')=='true')
  {
     $('#'+id+' .iconcls').removeClass('fa-angle-down');
     $('#'+id+' .iconcls').addClass('fa-angle-left');
  }
  else
  {
     $('#'+id+' .iconcls').removeClass('fa-angle-left');
     $('#'+id+' .iconcls').addClass('fa-angle-down');
  }
   
}