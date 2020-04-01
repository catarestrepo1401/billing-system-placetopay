{!! Field::number('identification', null, ['ph' => __('Identification')]) !!}
{!! Field::text('first_name', null, ['ph' => __('First name')]) !!}
{!! Field::text('last_name', null, ['ph' => __('Last name')]) !!}
{!! Field::email('email', null, ['ph' => __('Email')]) !!}
{!! Field::password('password', ['ph' => __('Password')]) !!}
{!! Field::select('roles[]', ['super-admin' => __('Super admin'), 'moderator' => __('Moderator'), 'guess' => __('Guess')], null, ['multiple']) !!}
