</div>
    </div>


  

    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    var sidebar = document.querySelector(".sidebar");
    var main_content = document.querySelector(".main-content");
    var sidebar_button = document.getElementById("sidebar-button");


    sidebar_button.addEventListener('click', () => {
        
        //Oculta a sidebar
        sidebar.classList.toggle('d-sm-none');

        // Adiciona
        main_content.classList.toggle("col-md-12");

    });


</script>

<footer class="py-3 my-4">
<ul class="nav justify-content-center border-bottom pb-3 mb-3"></ul>
    <p class="text-center text-muted">© 2023 IFvest</p>
</footer>

</body>

</html>