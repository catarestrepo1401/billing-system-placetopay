{!! Field::hidden('invoice', request()->invoice) !!}
{!! Field::number('identifier', null, ['ph' => __('Identifier')]) !!}
{!! Field::select('method') !!}
{!! Field::number('amount', request()->total, ['ph' => __('Amount')]) !!}
