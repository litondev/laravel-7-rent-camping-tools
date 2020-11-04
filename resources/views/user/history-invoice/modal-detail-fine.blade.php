<div class="modal no-border" 
	id="modal-detail-fine-invoice-{{$item->id}}">
	<div class="modal-dialog no-border">
      <div class="modal-content no-border">        
      	<div class="modal-header">
        	<h5 class="modal-title">
        		Detail Denda Invoice #{{$item->id}}
        	</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>

        <div class="modal-body no-border">
        	<table class="table table-hover">				        		        					        	
        		<tr>
        			<td>Denda Description</td>
        			<td>{{$item->fine_description}}</td>
        		</tr>
        		<tr>
        			<td>Denda Total</td>
        			<td>
        				<b class="badge badge-success">
                  Rp {{number_format($item->fine_total,"2")}}
                </b>
        			</td>
        		</tr>
	        </table>
        </div>      
      </div>
	</div>
</div>