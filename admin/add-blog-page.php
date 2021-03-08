<?php include("header.php");  ?>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<div class="container">
    <div class="row clearfix">
    	<div class="col-md-12 table-responsive">
			<table class="table table-bordered table-hover table-sortable" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							Name
						</th>
						<th class="text-center">
							Email
						</th>
						<th class="text-center">
							Notes
						</th>
    					<th class="text-center">
							Option
						</th>
        				<th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
						</th>
					</tr>
				</thead>
				<tbody>
    				<tr id='addr0' data-id="0" class="hidden">
						<td data-name="name">
						    <input type="text" name='name0'  placeholder='Name' class="form-control"/>
						</td>
						<td data-name="mail">
						    <input type="text" name='mail0' placeholder='Email' class="form-control"/>
						</td>
						<td data-name="desc">
						    <textarea name="desc0" placeholder="Description" class="form-control"></textarea>
						</td>
    					<td data-name="sel">
						    <select name="sel0">
        				        <option value="">Select Option</option>
    					        <option value="1">Option 1</option>
        				        <option value="2">Option 2</option>
        				        <option value="3">Option 3</option>
						    </select>
						</td>
                        <td data-name="del">
                            <button name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></button>
                        </td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<a id="add_row" class="btn btn-primary float-right">Add Row</a>
</div>
