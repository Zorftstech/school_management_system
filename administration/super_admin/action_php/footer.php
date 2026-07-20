            </main>

        </div>

    </div>

    <script>

        // vanilla js so the shell works even if the cdn scripts fail to load.....

        (function(){

            // highlight the current page in the sidebar.....

            var current = window.location.pathname.split('/').pop() || 'super_admin_home.php';

            var links = document.querySelectorAll('.dash-nav a');

            for (var i = 0; i < links.length; i++) {

                if (links[i].getAttribute('href') === current) {

                    links[i].className += ' active';
                }
            }


            // mobile sidebar toggle.....

            var dash = document.getElementById('dash');
            var menuBtn = document.getElementById('dash_menu_btn');
            var overlay = document.getElementById('dash_overlay');

            if (menuBtn) {

                menuBtn.addEventListener('click', function(){

                    dash.classList.toggle('nav-open');
                });
            }

            if (overlay) {

                overlay.addEventListener('click', function(){

                    dash.classList.remove('nav-open');
                });
            }

        })();

    </script>

    <script>

        $(document).ready(function(){

            // sections not yet wired to the multi-tenant backend..................

            $('.dash-nav a.nav-soon').click(function(event){

                event.preventDefault();

                $('#soon_notice').remove();

                $('.dash-topbar').after('<p id="soon_notice">this section arrives with the multi-tenant backend</p>');

                setTimeout(function(){
                    $('#soon_notice').remove();
                }, 4000);
            });

        });

    </script>

</body>
</html>
