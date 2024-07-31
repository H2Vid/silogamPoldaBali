<?php
$name = $name ?? $row->getField();
if ($row->getInputArray()) {
    $name .= '[]';
}
?>
{!! Input::call($row->getType(), [
    'name' => $name ?? $row->getField(),
    'value' => $shown_value,
    'lists' => $row->getLists(),
    'attr' => $attr,
    'as_form' => true,
]) !!}
