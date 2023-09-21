<b><i>👁Новая заявка по проекту👁</i></b>

<b>{{$project_name}}</b>

<b>📄 Заявка</b>
<b>{{$order_id}}</b>

<b>🥷 ФИО</b>
<b>{{$name}}</b>

<b>📫 Email</b>
<b>{{$email}}</b>

<b>💰 Банк</b>
🏦 Банк: <b>{{$bank['bank']}}</b>
💳 Реквизиты: <b>{{$bank['bank_number']}}</b>
🪪 Имя владельца: <b>{{$bank['name']}}</b>

<b>💰 Сумма</b>
<b>{{$amount}}</b>

@if(!is_null($rate))
{{$rate}}
@endif

@if(!is_null($comment))
<i>{{$comment}}</i>
@endif