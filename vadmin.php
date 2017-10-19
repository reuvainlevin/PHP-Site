<?php
    require 'uautoLoad.php';
    class Vadmin {
        public function __construct() {

        }

        public function render() {
?>
                <form class="form" action="index.php" method="post">
                    <h4><strong> Update item.</strong></h4>
                    <div class="form-group">
                        <label for="name" class="control-label">Change name: <?= $_SESSION['prepName'] ?> to:</label>
                        <input type="text" id="name" class="form-control" name="name" value=" <?= $_SESSION['prepName'] ?> ">
                    </div>
                    <div class="form-group">
                        <label for="price" class="control-label ">Change price:  <?= $_SESSION['prepPrice'] ?> to:</label>
                        <input type="number" id="price" class="form-control" name="price" step=".01" value="<?= $_SESSION['prepPrice'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label ">Change category - From: <?= $_SESSION['prepCategory'] ?>  To:</label>
                        <input type="text" id="category" class="form-control" name="category" value="<?= $_SESSION['prepCategory'] ?>">
                    </div>
                    <input type="hidden" name="prepId" value="<?= $_SESSION['prepId'] ?>">
                    <input class="btn btn-primary" type="submit" name="update" value="Update">	
                </form>

                <form class="form" action="index.php" method="post">
                    <h4><strong> Delete item.</strong></h4>
                    <h4> Name: <?= $_SESSION['prepName'] ?>.</h4>
                    <h4> Price: $<?= $_SESSION['prepPrice'] ?>.</h4>
                    <h4> Category: <?= $_SESSION['prepCategory'] ?>.</h4>  
                    <input type="hidden" name="prepId" value="<?= $_SESSION['prepId'] ?>">
                    <input class="btn btn-primary" type="submit" name="delete" value="Delete">
                </form>    
<?php	
                    if (!empty($_POST['delete'])) {
                        $delete = Madmin::getInstance();
                        $delete->delete();
                    }
?>
                <form class="form" action="index.php" method="post">
                    <h4><strong> Create new item.</strong></h4>
                    <div class="form-group">
                        <label for="name" class="control-label">Name:</label>
                        <input type="text" id="name" class="form-control" name="name" value="<?php  if (!empty($_POST['name'])) echo $_POST['name'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="price" class="control-label">Price:</label>
                        <input type="number" id="price" class="form-control" name="price" step=".01" value="<?php  if (!empty($_POST['price'])) echo $_POST['price'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label">Category:</label>
                        <input type="text" id="category" class="form-control" name="category" value="<?php  if (!empty($_POST['category'])) echo $_POST['category'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden"  name="create" value="create">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
<?php
        }
    }

?>