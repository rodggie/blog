<?php
    require 'partials/header.php';
?>
    <section class="form__section add__post">
        <div class="container form__section-container">
            <h2>Add Post</h2>
            <div class="alert__message error">
                <p>The error message goes here.</p>
            </div>
            <form action="" enctype="multipart/form-data">
                <input type="text" placeholder="Title">
                <select>
                    <option value="1">Wild Life</option>
                    <option value="2">Tourism</option>
                    <option value="3">Travel</option>
                    <option value="4">IT</option>
                </select>
                <textarea rows="11" placeholder="Body"></textarea>
                <div class="form__control inline">
                    <input type="checkbox"  id="is_featured" checked>
                    <label for="is_featured">Featured</label>
                </div>
                <div class="form__control">
                    <label for="thumbnail">Add Thumbnail</label>
                    <input type="file" name="" id="thumbnail">
                </div>
                <button type="submit" class="btn">Add</button>
            </form>
        </div>
    </section>

<?php
    require '../partials/footer.php';
?>