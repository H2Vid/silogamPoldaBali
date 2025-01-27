<?php
$pdfs = [];
if (isset($data->pdfs)) {
    $pdfs = json_decode($data->pdfs, true);
}
?>
<div class="form-group">
    <label>PDF Files</label>
    <div class="pdf-container">
        @forelse ($pdfs as $pdf)
            {!! Input::file()
                ->setName('pdfs[]')
                ->setValue($pdf)
                ->build() !!}
        @empty
            {!! Input::file()->setName('pdfs[]')->build() !!}
        @endforelse
    </div>
    <template id="pdf-item-input">
        {!! Input::file()->setName('pdfs[]')->build() !!}
    </template>
    <a href="#" class="btn btn-light btn-add-pdf">+ Add New Files</a>
</div>
<script>
$(function() {
    $('.btn-add-pdf').click(function(e) {
        e.preventDefault();
        var template = $('#pdf-item-input').html();
        $('.pdf-container').append(template);
    });
});
</script>