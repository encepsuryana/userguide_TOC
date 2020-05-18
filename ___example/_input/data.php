<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <td>No</td>
            <td>Feature Name</td>
            <td>Feature Parent</td>
            <td>Feature Link</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../config/koneksi.php';
        $no = 1;
        $query = "SELECT * FROM tbl_userguide ORDER BY id DESC";
        $user1 = $db1->prepare($query);
        $user1->execute();
        $res1 = $user1->get_result();

        if ($res1->num_rows > 0) {
            while ($row = $res1->fetch_assoc()) {
                $id = $row['id'];
                $feat_name = $row['feat_name'];
                $feat_parent = $row['feat_parent'];
                $feat_link = $row['feat_link'];
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $feat_name; ?></td>
                    <td><?php echo $feat_parent; ?></td>
                    <td><?php echo $feat_link; ?></td>
                    <td>
                        <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_data"> <i class="fa fa-edit"></i> Edit </button>
                        <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_data"> <i class="fa fa-trash"></i> Hapus </button>
                    </td>
                </tr>
            <?php } } else { ?> 
                <tr>
                    <td colspan='7'>Tidak ada data ditemukan</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
              "lengthMenu": [[5, 10, 15, -1], [5, 10, 50, "All"]]
          });
        } );

        function reset(){
            document.getElementById("err_feat_name").innerHTML = "";
            document.getElementById("err_feat_parent").innerHTML = "";
            document.getElementById("err_feat_link").innerHTML = "";
        }

        $(document).on('click', '.edit_data', function(){
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: "get_data.php",
                data: {id:id},
                dataType:'json',
                success: function(response) {
                    reset();
                    document.getElementById("id").value = response.id;
                    document.getElementById("feat_name").value = response.feat_name;
                    document.getElementById("feat_parent").value = response.feat_parent;
                    document.getElementById("feat_link").value = response.feat_link;
                    document.getElementById("feat_content").value = response.feat_content;
                }, error: function(response){
                    console.log(response.responseText);
                }
            });
        });

        $(document).on('click', '.hapus_data', function(){
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: "hapus_data.php",
                data: {id:id},
                success: function() {
                    $('.data').load("data.php");
                }, error: function(response){
                    console.log(response.responseText);
                }
            });
        });
    </script>