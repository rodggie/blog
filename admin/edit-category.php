<?php
    require 'partials/header.php';
?>
    <section class="form__section step">
        <div class="container form__section-container">
            <h2>Edit Category</h2>
            <form action="">
                <input type="text" placeholder="Title">
                <textarea rows="4" placeholder="Description"></textarea>
                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </section>

<?php
    require '../partials/footer.php';
?>