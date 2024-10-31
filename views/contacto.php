    <!-- SECTION CONTACTO -->
    <section id="contacto" class="section">
      <div class="p-4 bg-body-tertiary rounded-3">
        <div class="container pt-5 pb-2 nos-container">
          <h2 class="display-6 sm-h2 mb-4 text-center">Contacto</h2>
          <form method="post" action="views/enviar_formulario.php" name="formulario_contacto">
            <div class="mb-3">
              <input type="text" class="form-control" id="nombre" name="name" placeholder="Ingrese su nombre" required>
            </div>
            <div class="mb-3">
              <input type="tel" class="form-control" id="celular" name="cell" placeholder="Ingrese su número de teléfono">
            </div>
            <div class="mb-3">
              <input type="email" class="form-control" id="email" name="mail" placeholder="Ingrese su email" required>
            </div>
            <div class="mb-3">
              <textarea class="form-control" id="consulta" rows="3" name="textArea" placeholder="Ingrese su consulta" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
        </div>
      </div>
    </section>