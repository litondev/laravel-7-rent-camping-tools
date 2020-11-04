<div class="modal no-border" 
	id="modal-detail-product-invoice-{{$item->id}}">
	<div class="modal-dialog modal-lg no-border">
      <div class="modal-content no-border">        
      	<div class="modal-header">
        	<h5 class="modal-title">
        		Detail Product Invoice #{{$item->id}}
        	</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>

        <div class="modal-body no-border">
        	<table class="table table-hover">				        		        					        	
        		@foreach($item->order_items as $item_order)				        
        		<tr>
	        		<td class="no-border">
	        			{{$item_order->product->name}}
	        		</td>
	        		<td class="no-border">
	        			<b class="badge badge-success">
	        				{{$item_order->product->get_rent_price}}
	        			</b>
	        		</td>
	        		<td class="no-border">
	        			<button class="btn btn-primary" 
	        				onclick="window.location='{{url('/product/'.$item_order->product->id)}}'">
	        				Detail
	        			</button>
	        		</td>
	        	</tr>
	     		@endforeach
	        </table>
        </div>      
      </div>
	</div>
</div>