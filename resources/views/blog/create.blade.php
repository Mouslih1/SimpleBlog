@extends('base')
@section('title', isset($title) ? $title : 'Créer un article')
@section('content')

<h2>Ajouter un article</h2>
@include('blog.form')
@endsection
