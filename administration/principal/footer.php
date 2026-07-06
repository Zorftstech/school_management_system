            </main>

        </div>

    </div>

    <script>

        // vanilla js so the shell works even if the cdn scripts fail to load.....

        (function(){

            // highlight the current page in the sidebar.....

            var current = window.location.pathname.split('/').pop() || 'principal_home.php';

            // registration and view pages highlight their parent sidebar entry.....

            var alias = {
                'admin_personel_registration.php': 'admin_personel_detail.php',
                'admin_personel_resend_email.php': 'admin_personel_detail.php',
                'admin_personel_email_verification.php': 'admin_personel_detail.php',
                'academic_officer_registration.php': 'academic_officer_detail.php',
                'academic_officer_resend_email.php': 'academic_officer_detail.php',
                'academic_officer_email_verification.php': 'academic_officer_detail.php',
                'exam_officer_registration.php': 'exam_officer_detail.php',
                'exam_officer_resend_email.php': 'exam_officer_detail.php',
                'exam_officer_email_verification.php': 'exam_officer_detail.php',
                'finance_officer_registration.php': 'finance_officer_detail.php',
                'finance_officer_resend_email.php': 'finance_officer_detail.php',
                'finance_officer_email_verification.php': 'finance_officer_detail.php',
                'school_fees_details_view.php': 'school_fees_details_form.php',
                'school_deposit_details_view.php': 'deposit_details_form.php',
                'school_withdraw_details_view.php': 'withdraw_details_form.php',
                'pupil_school_fees_details_view.php': 'pupil_school_fees_details_form.php',
                'pupil_school_deposit_details_view.php': 'pupil_deposit_details_form.php',
                'pupil_school_withdraw_details_view.php': 'pupil_withdraw_details_form.php'
            };

            if (alias[current]) {

                current = alias[current];
            }

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

</body>
</html>
