<div class="modal fade" id="cnote">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
      <h4>Nueva Nota</h4>
              <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
              </button>
    </div>
    <form method="POST" action="/pacientes/{{ $report->id }}/nota" enctype="multipart/form-data">
      <div class="modal-body">
        @csrf
        <div class="form-group">
          <label for="titulo">Nota Terapeutica</label>
          <textarea type="text"
            name="nota"
            class="form-control"
            id="nota"
            placeholder="Nota Terapeutica"
            required
            value={{ old('nota') }} 
            cols="30" rows="6">
          </textarea>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Guardar">
      </div>
    </form>
      </div>
  </div>
</div>
