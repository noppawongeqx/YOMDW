<div class="box">
	<div class="box-header"> <h3> Slideshows </h3> <a  href="<?= base_url() ?>admin/slideshow" class="btn btn-success">เพิ่ม </a>
		</div>
	<div class="box-body"> 

			<table class="table table-stripped">
					<thead>
						<th>title</th>
						<th>link</th>
						<th>position</th>
						<th></th>
					</thead>
					<tbody>
						<?php foreach ($slideshows->result_array() as $row) { ?>
						<tr>
							<td><a href="<?= base_url() ?>admin/slideshow/<?= $row['id']?>"><?= $row['title'] ?></a></td>
							<td><?= $row['link'] ?> </td>
							<td> <?= $row['position'] ?></td>
							<td><a class="btn btn-danger" href="<?= base_url() ?>admin/slideshow/delete/<?= $row['id']?>">ลบ</a></td>
						</tr>
						<?php } ?>
					</tbody>

			</table>
 			
	</div>
</div>