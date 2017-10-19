<?php
    require 'uautoLoad.php';

    class Vhome {
        private $mhome;
        private $vadmin;
        private $admin;
        private $madmin;
        public function __construct() {
            session_start();
            if (empty($_SESSION['firstTimeHere'])) {
                $defaults = new Usetdefaults();
                $defaults->setDefaults();
            }
            $this->mhome = new Mhome();
            $this->vadmin = new Vadmin();
            $this->admin = new Mpassword();
            $this->madmin = Madmin::getInstance();
        }
        public function render() {
            $siteNames = $this->mhome->getSiteNames(); 
            $siteName = $this->mhome->getSiteName();                         
?>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <?php foreach($siteNames as  $site) : ?>
                        <div class="navbar-header well">
                            <form class="form-inline" action="index.php" method="post">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="<?= $site['store'] ?>" value="<?= $site['store'] ?>">
                                    <button type="submit" class="btn btn-primary"><?= $site['store'] ?> Store</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                    <div class="navbar-header ">
                        <h3>Welcome to the <?= $siteName ?> Store</h3>
                    </div>
                    <div class="nav navbar-nav navbar-right well">
                    <?php if ($_SESSION['admin'] === 'no') { ?>
                        <div class="navbar-header">
                            <form class="form-inline" action="index.php" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user"  placeholder="User Name">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"  placeholder="Password">
                                </div>
                                <input type="hidden"  name="admin" value="admin">
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <div class="navbar-header">
                            <form class="form-inline" action="index.php" method="post">
                                <div class="form-group">
                                    <input type="hidden"  name="logout" value="logout">
                                    <button type="submit" class="btn btn-primary">Log out</button>
                                </div>
                            </form>
                        </div>
                   <?php }  ?>                    
                    </div>
                </div>
            </nav>
<?php  
             if (!empty($_POST['logout'])) {
                $this->admin->logout();
            }     
            if (!empty($_POST['admin'])) {
                $this->admin->verifyPassword();
            }
            if (!empty($_POST['create'])) {
                $this->madmin->create();
            }
            if (!empty($_POST['prepItem'])) {
                $this->madmin->prepVal();
            }
            if (!empty($_POST['update'])) {
                $this->madmin->update();
                $defaults = new Usetdefaults();
                $defaults->setSiteDefaults();
            }
            if (!empty($_POST['confirmDelete'])) {
                $this->madmin->confirmDelete();
                $defaults = new Usetdefaults();
                $defaults->setSiteDefaults();
            }  
            if (!empty($_POST['delete'])) {
                $this->madmin->deleteWarning();
            }  
            $results = $this->mhome->getCategorys();
            $getrows = $this->mhome->getRows();
?>
                <div class="well col-lg-4">
                        <form class="form-inline" action="index.php" method="post">
                            <div class="form-group">
                                <label for="category" class="control-label">Choose a category:</label>
                                <select class="form-control" id="category" name="category">       
                                        <?php foreach ($results as $category) : ?>
                                            <option value="<?= $category['category']?>" <?php if($category['category'] === $_SESSION['category']) echo'selected'?> >
                                                <?= $category['category']?>
                                            </option>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Sort">
                        </form>
                        <hr>

                        <p>&downarrow; For admin use only. &downarrow;</p>
                        <form class="form-inline" action="index.php" method="post">
                            <div class="form-group">
                                <label for="prepItem" class="control-label">Choose an item:</label>
                                <select class="form-control" id="prepItem" name="prepItem">       
                                        <?php foreach ($getrows as $item) : ?>
                                            <option value="<?= $item['id']?>" <?php if($item['id'] === $_SESSION['prepId']) echo'selected'?>>
                                                <?= $item['name']?>
                                            </option>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Choose an item">
                        </form>
                    <?php $this->vadmin->render(); ?>  
                </div>

                <div class="col-lg-8">
                    <div class="well">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($getrows as $row) : ?>
                                    <tr>
                                        <td><?= $row['name']?></td>
                                        <td><?= $row['price']?></td>
                                        <td><?= $row['category']?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
<?php
        }
    }
?>