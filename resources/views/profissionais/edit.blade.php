@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white-900 mb-2">Editar Profissional</h1>
            <p class="text-gray-600">Atualize as informações do profissional</p>
        </div>

        <!-- Formulário de Edição -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <div class="flex items-center mb-6">
                <div class="bg-yellow-100 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Editar Informações</h2>
                    <p class="text-gray-600 text-sm">Atualize os dados do profissional {{ $profissional->nome }}</p>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">Corrija os erros abaixo:</span>
                    </div>
                    <ul class="list-disc pl-7 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profissionais.update', $profissional->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome Completo <span class="text-gray-400">(não editável)</span>
                        </label>
                        <input type="text" name="nome" id="nome" value="{{ $profissional->nome }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed"
                            readonly>
                        <p class="text-gray-500 text-xs mt-1">O nome do profissional não pode ser alterado</p>
                    </div>

                    <div>
                        <label for="especialidade" class="block text-sm font-medium text-gray-700 mb-2">
                            Especialidade <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="especialidade" id="especialidade" value="{{ old('especialidade', $profissional->especialidade) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors text-gray-900 bg-white placeholder-gray-500 @error('especialidade') border-red-300 @enderror"
                            required placeholder="Ex: Extensão de cílios, Designer">
                        @error('especialidade')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('profissionais.index') }}" 
                        class="mb-3 sm:mb-0 text-gray-600 hover:text-gray-800 font-medium inline-flex items-center transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Voltar para a lista
                    </a>
                    
                    <div class="flex space-x-3">
                        <button type="button" onclick="window.history.back()" 
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-3 rounded-lg transition-colors duration-200 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </button>
                        
                        <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-200 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Salvar Alterações
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Card de Informações Atuais -->
        <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 mt-8">
            <div class="flex items-center mb-4">
                <div class="bg-gray-200 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Informações Atuais</h3>
                    <p class="text-gray-600 text-sm">Dados salvos no sistema</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <dt class="text-sm font-medium text-gray-500 mb-1">Nome</dt>
                    <dd class="text-sm text-gray-900 font-medium">{{ $profissional->nome }}</dd>
                </div>
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <dt class="text-sm font-medium text-gray-500 mb-1">Especialidade</dt>
                    <dd class="text-sm text-gray-900 font-medium">{{ $profissional->especialidade }}</dd>
                </div>
            </div>
        </div>

        <!-- Card de Informações Adicionais -->
        <div class="bg-blue-50 rounded-xl border border-blue-200 p-6 mt-6">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3 flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-blue-900 mb-1">Importante</h4>
                    <p class="text-sm text-blue-800">
                        O nome do profissional não pode ser alterado por questões de integridade dos dados. 
                        Apenas a especialidade pode ser modificada.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection