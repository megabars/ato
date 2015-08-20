<div class="qq-uploader">
	<div class="qq-upload-button btn btn-green"><?php echo $label ?></div>
	<div class="qq-upload-drop-area">
		<span>Кинь файл</span>
	</div>
	<div class="files-wrapper">
		<?php


		if (!empty($model->{$relation}))
			foreach ($model->{$relation} as $index => $item)
				if ($item->file){?>

					<div class="qq-upload-files">
						<table style="width: auto;border: 1px dotted #428BCA">
							<tr>
								<td>
									<span class="qq-upload-file"><?php echo $item->file->origin_name ?></span>
								</td>
							</tr>
							<tr>
								<td>
									<span><?php echo $item->getDate(''); ?></span>
								</td>
							</tr>
							<tr>
								<td>
									<span><?php echo $item->getFileSize('') ?></span>
								</td>
							</tr>
							<tr>
								<td>
									<span class="drop-file" data-file="<?php echo $item->id ?>">Удалить</span>
								</td>
							</tr>
						</table>
					</div>
				<?php } ?>
	</div>
	<ul class="qq-upload-list"></ul>
</div>