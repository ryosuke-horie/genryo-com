@extends('layouts/parents')
@include('./layouts/head')
@include('./layouts/header')

@section('content')
    @if (!empty($weight_log))
        <table class="table-auto mx-auto my-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">記録日時</th>
                    <th class="px-4 py-2">体重</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weight_log as $key => $val)
                
                    <tr>
                        <td class="border px-4 py-2">{{ $val['updated_at'] }}</td>
                        <td class="border px-4 py-2">{{ $val['weight'] }}</td>
                        <td class="border px-4 py-2">
                            <button class="bg-gray-600 hover:bg-gray-500 text-white rounded px-4 py-2">編集</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        データは未登録です。
    @endif
@endsection

@include('./layouts/footer')
