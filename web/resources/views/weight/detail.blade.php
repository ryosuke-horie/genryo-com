@extends('layouts/parents')
@include('./layouts/head')
@include('./layouts/header')

@section('content')
    <table class="table-auto m-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">記録日時</th>
                <th class="px-4 py-2">体重</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-4 py-2">2022年11月28日</td>
                <td class="border px-4 py-2">61.5</td>
                <td class="border px-4 py-2">編集</td>
            </tr>
        </tbody>
    </table>
@endsection

@include('./layouts/footer')
