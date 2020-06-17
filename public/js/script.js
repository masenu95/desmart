 $(function () {
     $('.dropdown-link').click(function (e) {
         let a = $(this).children('ul');
         a.toggle('.show');
     });

     $('.full-screen').click(function (e) {
         $('.side-bar').toggle('.hide');
         $('#full-screen').remove('.margin');
     });

     $('.toggle-nav a').click(function (e) {
         $('.side-bar').toggle('.display');
     });


     $('.dash-table').DataTable({
         "scrollY": "200px",
         "scrollCollapse": true,
         "scrollX": true
     });

     $('#dt-page').DataTable({
        "scrollCollapse": true,
        "scrollX": true
    });
     $('.dataTables_length').addClass('bs-select');

     $("input[type='checkbox']").click(function (e) {
         let b = $(this).parents('li');
         if ($("input[type='checkbox']").is(":checked")) {
             b.addClass('done');
         }else{
             b.removeClass('done');
         }
     });


 });


const input = document.getElementById("search-input");
const searchBtn = document.getElementById("search-btn");

const expand = () => {
  searchBtn.classList.toggle("close");
  input.classList.toggle("square");
};

searchBtn.addEventListener("click", expand);

