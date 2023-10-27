@extends('errors.minimal')

@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Não tem permissões para aceder a esta página.'))
