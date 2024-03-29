@extends('front::layouts.master', [
	'htmlTitle' => 'Candidat ou entreprise, contacter l\'agence pour l\'emploi Front Paris',
	'metaDescription' => 'Vous êtes demandeur d\'emploi ou recruteur ? Candidat ou entreprise, contactez l\'agence pour l\'emploi Front Paris.'
])


@section('content')
    <div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/front/images/offer-banner.jpg')}}')">
      <div class="horizontal-inner-container">
          <h1>Contactez l'agence pour l'emploi Front Paris</h1>
        </div>
      </div>
    </div>
    <div class="candidate-container">
      <div class="horizontal-inner-container">

        <div class="candidate-list">
          <ol class="breadcrumb">
            <li><a href="{{route('home')}}">ACCUEIL</a></li>
            <li>CONTACTEZ-NOUS</li>
          </ol>

          <div>
            <h2>CONTACTEZ-NOUS</h2>
<p>Entreprises ou candidats en recherche de poste sur Paris et en banlieue (92, 93 et 94), contactez notre agence pour l'emploi Front Paris spécialisée dans les métiers du tertiaire. Intérim, CDD, CDI… Notre équipe se fera un plaisir de répondre à vos demandes.<p>
            @if(Session::has('notify_success'))
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                    {{Session::get('notify_success')}}
                  </div>
                </div>
              </div>
            @endif

            @if(Session::has('notify_error'))
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-error">
                    {{Session::get('notify_error')}}
                  </div>
                </div>
              </div>
            @endif

            @if ($errors->any())
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
              </div>
            @endif


            {!!
  			        Form::open([
  			            'url' => route('contact.send'),
  			            'method' => 'POST'
  			        ])
  			    !!}
              <div class="col-md-6">
                {!! Form::Label('surname', 'Prénom') !!}
                {!!
                  Form::text('first_name', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Prénom'
                  ])
                !!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('nom', 'Nom') !!}
                {!!
  								Form::text('last_name', null, [
  									'class' => 'form-control',
  									'placeholder' => 'Nom'
  								])
  							!!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('email', 'E-mail') !!}
                {!!
  								Form::text('email', null, [
  									'class' => 'form-control',
  									'placeholder' => 'E-mail'
  								])
  							!!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('subject', 'Sujet') !!}
                {!!
  								Form::text('subject', null, [
  									'class' => 'form-control',
  									'placeholder' => 'Sujet'
  								])
  							!!}
              </div>
              <div class="col-md-12">
                {!! Form::Label('message', 'Message') !!}
                {!!
  								Form::textarea('message', null, [
  									'class' => 'form-control',
  									'placeholder' => 'Message...'
  								])
  							!!}
              </div>
              <br clear="all">
              <div class="btn-red-container">
                {!!
  								Form::submit('ENVOYER', [
  									'class' => 'btn btn-red'
  								])
  							!!}
              </div>
            {{ Form::close()}}
          </div>

          <br clear="all">
        </div>
      </div>
    </div>
@endsection

@push('javascripts')
	<script>

    $(document).ready(function() {
        $(document).on("click","#btn-more",function() {
          $(this).hide();
          $('#btn-less').show();
          $('.light-gray-search-container').show();
        });

        $(document).on("click","#btn-less",function() {
          $(this).hide();
          $('#btn-more').show();
          $('.light-gray-search-container').hide();
        });
        $(document).ready(function() {
            $(document).on("click",".btn-search",function() {
              $(this).closest('form').submit();
            });
        });
        $(document).ready(function() {
            $(document).on("click","#btn-filtres",function() {
              $(this).closest('form').submit();
            });
        });


    });

  </script>

@endpush
