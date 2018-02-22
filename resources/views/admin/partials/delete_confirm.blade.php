<!-- Modal Dialog -->
<div class="modal fade" id="mod_delete" tabindex="-1" role="dialog" aria-labelledby="Eliminar Item" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary col-sm-2 pull-right submit" style="margin-right:10px;">Yes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function(){
  $('.mod_delete').on('click', function(e) {
        e.preventDefault();
        var el = $(this).parent();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var id = el.attr('data-form');
        
        $('#mod_delete')
        .find('.modal-body').html(msg)
        .end().find('.modal-title').html(title)
        .end().modal('show');
        
        $('#mod_delete').find('.submit').attr('data-form', id);
  });

  $('#mod_delete').on('click', '.submit', function(e) {
        var id = $(this).attr('data-form');
        $(id).submit();
  });
});
</script>