<?php
    require 'partials/header.php';
?>
    <section class="form__section step">
        <div class="container form__section-container">
            <h2>Add Category</h2>
            <div class="alert__message error">
                <p>The error message goes here.</p>
            </div>
            <form action="">
                <input type="text" placeholder="Title">
                <textarea rows="4" placeholder="Description"></textarea>
                <button type="submit" class="btn">Add</button>
            </form>
        </div>
    </section>

<?php
    require '../partials/footer.php';
?>