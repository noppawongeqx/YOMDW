<div class="box">
	<div class="box-header"> <h3> News </h3> <a  href="<?= base_url() ?>admin/news" class="btn btn-success">เพิ่ม </a>
		</div>
	<div class="box-body"> 

			<table class="table table-stripped">
					<thead>
						<th>title</th>
						<th></th>
					</thead>
					<tbody>
						<?php foreach ($newslist->result_array() as $row) { ?>
						<tr>
							<td><a href="<?= base_url() ?>admin/news/<?= $row['id']?>"><?= $row['title'] ?></a></td>
							<td><a class="btn btn-danger" href="<?= base_url() ?>admin/news/delete/<?= $row['id']?>">ลบ</a></td>
						</tr>
						<?php } ?>
					</tbody>

			</table>
 			
	</div>
</div>