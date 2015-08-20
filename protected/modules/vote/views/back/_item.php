<tr class="vote-qestion-item-block">
	<td>
		<?php echo CHtml::textField("Vote[voteItems][{$id}]", $title, array('size' => 60, 'maxlength' => 255)); ?>
	</td>
	<td>
		<?php
            echo CHtml::link(CHtml::image($this->getAssetsBase() . '/images/delete.png'), '#',
                array('class' => 'delete-item', 'data-id' => $id));
        ?>
	</td>
</tr>