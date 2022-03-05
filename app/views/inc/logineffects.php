<?php if (!empty($data['errorMsg'])) : ?>
    <script>
        $(document).ready(function() {

            const element = document.querySelector('#loginForm');
            element.classList.add('animated', 'shake');
            setTimeout(function() {
                element.classList.remove('shake');
            }, 1000);

        });
    </script>
    <!-- <script>
        $(document).ready(function() {

            const element = document.querySelector('#error');
            element.classList.add('animated', 'shake');
            setTimeout(function() {
                element.classList.remove('shake');
            }, 1000);

        });
    </script> -->
<?php endif; ?>