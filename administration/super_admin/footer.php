        </main>

        <script>

            $(document).ready(function(){

                // sidebar toggle for small screens..................

                $('#menu_toggle').click(function(){

                    $('#sidebar').toggleClass('open');
                });


                // sections not yet wired to the multi-tenant backend..................

                $('.nav_soon a').click(function(event){

                    event.preventDefault();

                    $('#soon_notice').remove();

                    $('#topbar').after('<p id="soon_notice">this section arrives with the multi-tenant backend</p>');

                    setTimeout(function(){
                        $('#soon_notice').remove();
                    }, 4000);
                });

            });

        </script>

    </body>
</html>
