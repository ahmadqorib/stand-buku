<?php
if(isset($_POST['page'])){
    //Include pagination class file
    include('Pagination.php');
    
    //Include database configuration file
    include('confiq/koneksi.php');
    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 18;
    
    //get number of rows
    $queryNum = $kon->query("SELECT COUNT(*) as postNum FROM bazzar_buku");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];
    
    //initialize pagination class
    $pagConfig = array('baseURL'=>'getData.php', 'totalRows'=>$rowCount, 'currentPage'=>$start, 'perPage'=>$limit, 'contentDiv'=>'posts_content');
    $pagination =  new Pagination($pagConfig);
    
    //get rows
    $query = $kon->query("SELECT * FROM bazzar_buku ORDER BY judul_buku DESC LIMIT $start,$limit");
    
    if($query->num_rows > 0){ ?>
        <div class="row">
            <div id="posts_content">
                <?php
                    while($row = $query->fetch_assoc()){ 
                        $postID = $row['id_buku'];
                        $hargat = $row['harga'] - ($row['diskon']/100*$row['harga']);
                        $totalS = strlen($row['judul_buku']);
                        if($totalS >= 43){
                            $num_char = 43;
                            $judul = substr($row['judul_buku'], 0, $num_char) . '...';
                        }else{
                            $judul = $row['judul_buku'];
                        }
                ?>
                <div class="col-md-2 col-sm-6" style="position: inherit; height:auto;">
                    <div class="thumbnail">
                        <div class="data">
                            <?php if($row['foto']!=""){ ?>
                                <img height="100" src="admin/images/buku/<?=$row['foto'];?>" class="img-responsive" width="300" >
                            <?php } ?>
                        </div>
                        <div class="caption">
                            <h4><a href="detail_buku.php?id_buku=<?php echo $row['id_buku']; ?>" target="_blank"><?= $judul; ?></a></h4>
                            <div class="ui-group-buttons">
                            <?php if($row['diskon']>0){ ?>
                                    <button type="button" class="btn btn-danger btn-xs"><?= $row['diskon']?>%</button>
                            <?php } ?>
                                <div class="or or-xs"></div>
                                <button type="button" class="btn btn-success btn-xs">Rp <?php echo number_format($hargat,0,",","."); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
                <div style="text-align: center;">
                    <?php echo $pagination->createLinks(); ?>   
                </div>
            </div>
        </div>
            
<?php }
}
?>
