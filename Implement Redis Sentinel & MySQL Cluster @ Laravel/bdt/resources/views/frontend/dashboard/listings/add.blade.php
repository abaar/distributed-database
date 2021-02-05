@extends('frontend.dashboard.layout')

@section('title', 'Add Listing Property | ')

@section('content')
<div class="widget js-widget widget--dashboard">
	<div class="widget__header">
	  <h2 class="widget__title">Add new property</h2>
	</div>
	<div class="widget__content">
	  <!-- BEGIN Favorites-->
	  <section class="form-property form-property--dashboard">
	    <!-- Nav tabs-->
	    <ul role="tablist" class="nav form-property__tabs">
	      <li role="presentation" class="{{session('success') ? '' : 'active'}}"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Informasi Umum</a></li>
	      <li role="presentation" class="{{session('success') ? 'active' : ''}}"><a href="#Photo" aria-controls="Photo" role="tab" data-toggle="tab">Photo</a></li>
	    </ul>
	    <!-- Tab panes-->
	    <div class="tab-content form-property__content">
	      @if ($errors->any())
          <div class="alert alert-danger text-left">
            <strong>Failed</strong>
            @if ($errors->has('message'))
              <p>{{ $errors->first('message') }}</p>
            @endif
{{--             @foreach($errors->all() as $error)
            	<li>{{ $error }}</li>
            @endforeach --}}
          </div>
          @endif
	      <div id="basic" role="tabpanel" class="tab-pane {{session('success') ? '' : 'active'}}">
	        <form method="post" action="{{route('listings.property.store')}}" class="form form--flex form--property form--basic js-form-property-1" id="form-add-property" @submit='insertDesc'>
	        	@csrf
	          <div class="row">
	            <div class="form-group required form-group--description {{($errors->has('name')) ? 'has-error' : ''}}">
	              <label for="in-1" class="control-label">Nama Properti</label>
	              <input id="in-1" required type="text" name="name" data-placeholder="---" value="{{ old('name') }}" class="form-control" required>
	              	@if ($errors->has('name'))
                    	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('name') }}</div></div>
                    @endif
	            </div>

	            <div class="form-group required {{($errors->has('listing_type')) ? 'has-error' : ''}}">
	              <label for="in-15" class="control-label">Tipe</label>
	              <select id="in-15" required name="listing_type" data-placeholder="---" class="form-control">
	                <option value="sale" {{ (old('listing_type') == 'sale') ? 'selected' : '' }}>Dijual</option>
	                <option value="rent" {{ (old('listing_type') == 'rent') ? 'selected' : '' }}>Disewa</option>
	              </select>
	              @if ($errors->has('listing_type'))
                    <div class="help-block filled"><div class="parsley-required">{{ $errors->first('listing_type') }}</div></div>
                  @endif
	            </div>

	            <div class="form-group required {{($errors->has('property_type')) ? 'has-error' : ''}}">
	              <label for="in-2" class="control-label">Kategori</label>
	              <select id="in-2" required name="property_type" data-placeholder="---" class="form-control" v-model="CategorySelected">
	                @foreach($propertyTypees as $propertyType)
	                <option value="{{$propertyType->id}}" {{(old('property_type') == $propertyType->id) ? 'selected' : ''}}>{{$propertyType->name}}</option>
	                @endforeach
	              </select>
	              @if ($errors->has('property_type'))
                    <div class="help-block filled"><div class="parsley-required">{{ $errors->first('property_type') }}</div></div>
                  @endif
	            </div>

	            <div class="form-group required {{($errors->has('built_up')) ? 'has-error' : ''}}" v-if="CategorySelected != '3'">
	              <label for="in-9" class="control-label">Luas Bangunan</label>
	              <input id="in-9" name="built_up" type="number" min="0" value="{{ old('built_up') }}" placeholder="" class="form-control" required>
								@if ($errors->has('built_up'))
                  <div class="help-block filled"><div class="parsley-required">{{ $errors->first('built_up') }}</div></div>
                @endif
				</div>

	            <div class="form-group required {{($errors->has('land_size')) ? 'has-error' : ''}}" v-if="CategorySelected != '2'">
	              <label for="in-10" class="control-label">Luas Tanah</label>
	              <input id="in-10" name="land_size" type="number" min="0" value="{{ old('land_size') }}" placeholder="" required class="form-control">
								@if ($errors->has('land_size'))
                  <div class="help-block filled"><div class="parsley-required">{{ $errors->first('land_size') }}</div></div>
                @endif
				</div>

	            <div class="form-group required {{($errors->has('price')) ? 'has-error' : ''}}">
	              <label for="in-11" class="control-label"> Harga</label>
	              <input id="in-11" type="text" name="price" value="{{ old('price') }}" placeholder="" required class="form-control" @blur="genPrice" v-model="Price" @keypress="isNumber">
	              @if ($errors->has('price'))
	              	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('price') }}</div></div>
	              @endif
	            </div>

	            <div class="form-group required {{($errors->has('address')) ? 'has-error' : ''}}">
	              <label for="in-12" class="control-label"> Alamat </label>
	              <input id="in-12" type="text" placeholder="" name="address" value="{{ old('address') }}" required class="form-control">
	              @if ($errors->has('address'))
	              	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('address') }}</div></div>
	              @endif
	            </div>


	            <div class="form-group required {{($errors->has('provinces')) ? 'has-error' : ''}}">
                  <label for="in-4" class="control-label">Provinsi</label>
                  {{-- Template for vue js --}}
                  <select3 id="in-4" data-placeholder="Pilih Provinsi..." required class="form-control" name="provinces" :options="provinces_options" v-model="provinceSelected">
                    <option></option>
                  </select3>
                  @if ($errors->has('provinces'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('provinces') }}</div></div>
                  @endif
                </div>


	            <div class="form-group required {{($errors->has('cities')) ? 'has-error' : ''}}">
                  <label for="in-5" class="control-label">Kota</label>
                  {{-- Template for vue js --}}
                  <select2 id="in-5" data-placeholder="Pilih Kota..." required class="form-control" name="cities" :options="options" v-model="citySelected">
                    <option></option>
                  </select2>
                  @if ($errors->has('cities'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('cities') }}</div></div>
                  @endif
                </div>


	            <div class="form-group required {{($errors->has('subdistrict')) ? 'has-error' : ''}}">
                  <label for="in-6" class="control-label">Kecamatan</label>
                  <select id="in-6" required class="form-control" name="subdistrict">
                  	<option></option>
                  </select>
                  @if ($errors->has('subdistrict'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('subdistrict') }}</div></div>
                  @endif
                </div>


	            <div class="form-group required {{($errors->has('bedrooms')) ? 'has-error' : ''}}" v-if="CategorySelected == '1' || CategorySelected == '2' || CategorySelected == '6'">
	              <label for="in-14" class="control-label"> Kamar Tidur </label>
	              <input id="in-14" type="number" min="0" name="bedrooms" value="{{ old('bedrooms') }}" placeholder="" required class="form-control">
				  @if ($errors->has('bedrooms'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('bedrooms') }}</div></div>
                  @endif
	            </div>

	            <div class="form-group required {{($errors->has('bathrooms')) ? 'has-error' : ''}}" v-if="CategorySelected != '3' && CategorySelected != '5'">
	              <label for="in-15" class="control-label"> Kamar Mandi </label>
	              <input id="in-15" type="number" min="0" name="bathrooms" value="{{ old('bathrooms') }}" placeholder="" required class="form-control">
				  @if ($errors->has('bathrooms'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('bathrooms') }}</div></div>
                  @endif	            
	            </div>

	            <div class="form-group" v-if="CategorySelected == '1'">
	            	<label class="control-label"> Kamar Tidur Pembantu </label>
	            	<input type="number" min="0" name="maid_bedrooms" value="{{ old('maid_bedrooms') }}"  placeholder=""  class="form-control">
	            </div>

	            <div class="form-group" v-if="CategorySelected == '1'">
	            	<label class="control-label"> Kamar Mandi Pembantu </label>
	            	<input type="number" min="0" name="maid_bathrooms" value="{{ old('maid_bathrooms') }}" placeholder=""  class="form-control">
	            </div>

	            <div class="form-group required {{($errors->has('certificate')) ? 'has-error' : ''}}" v-if="CategorySelected != '6'">
	            	<label class="control-label"> Sertifikat </label>
	            	<input type="text" name="certificate" value="{{ old('certificate') }}" placeholder="" required class="form-control">
				  @if ($errors->has('certificate'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('certificate') }}</div></div>
                  @endif
	            </div>

	            <div class="form-group required {{($errors->has('year_built')) ? 'has-error' : ''}}" v-if="CategorySelected != '3'">
	            	<label class="control-label"> Tahun Dibangun </label>
	            	<select data-placeholder="Pilih Tahun" required class="form-control" name="year_built">
	                    @for($th=\Carbon\carbon::now()->format('Y');$th>=1970;$th--)
	                    <option value="{{$th}}" {{ old('year_built') == $th ? 'selected' : ''}}>{{$th}}</option>
	                    @endfor
	                </select>
				  @if ($errors->has('year_built'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('year_built') }}</div></div>
                  @endif
	            </div>
	            <div class="form-group" v-if="CategorySelected == '1' || CategorySelected == '6'">
	              <label for="in-16" class="control-label"> Garasi </label>
	              <input id="in-16" type="number" min="0" name="garages" value="{{ old('garages') }}" placeholder="" class="form-control">
	            </div>
	            <div class="form-group required {{($errors->has('electrical_power')) ? 'has-error' : ''}}" v-if="CategorySelected != '3'">
	              <label class="control-label"> Daya Listrik </label>
	              <input type="number" min="0" name="electrical_power" value="{{ old('electrical_power') }}" placeholder="" required class="form-control">
				  @if ($errors->has('electrical_power'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('electrical_power') }}</div></div>
                  @endif
	            </div>
	            <div class="form-group required {{($errors->has('number_of_floors')) ? 'has-error' : ''}}" v-if="CategorySelected == '1' || CategorySelected == '4'">
	              <label class="control-label"> Jumlah Lantai </label>
	              <input type="number" min="0" name="number_of_floors" value="{{ old('number_of_floors') }}" placeholder="" required class="form-control">
	              @if ($errors->has('number_of_floors'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('number_of_floors') }}</div></div>
                  @endif
	            </div>
	            <div class="form-group" v-if="CategorySelected != '3' && CategorySelected != '5'">
	              <label class="control-label"> Jumlah DP </label>
	              <input type="text" name="amount_of_down_payment" value="{{ old('amount_of_down_payment') }}" placeholder=""  class="form-control" @blur="genDP" v-model="DP" @keypress="isNumber">
	            </div>
	            <div class="form-group" v-if="CategorySelected != '3' && CategorySelected != '5'">
	              <label class="control-label"> Estimasi Cicilan </label>
	              <input type="number" min="0" name="estimated_installments" value="{{ old('estimated_installments') }}" placeholder=""  class="form-control">
	            </div>
	            <div class="form-group required {{($errors->has('complete_address')) ? 'has-error' : ''}}">
	              <label class="control-label"> Alamat Lengkap</label>
	              <input type="text" name="complete_address" value="{{ old('complete_address') }}" placeholder="" required class="form-control">
	              @if ($errors->has('complete_address'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('complete_address') }}</div></div>
                  @endif
	            </div>
	            <div class="form-group required {{($errors->has('owner_name')) ? 'has-error' : ''}}">
	              <label class="control-label"> Nama Pemilik</label>
	              <input type="text" name="owner_name" value="{{ old('owner_name') }}" placeholder="" required class="form-control">
	              @if ($errors->has('owner_name'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('owner_name') }}</div></div>
                  @endif
	            </div>
	            <div class="form-group required {{($errors->has('owner_phone')) ? 'has-error' : ''}}">
	              <label class="control-label"> Telepon Pemilik</label>
	              <input type="text" name="owner_phone" value="{{ old('owner_phone') }}" placeholder="" required class="form-control">
	              @if ($errors->has('owner_phone'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('owner_phone') }}</div></div>
                  @endif
	            </div>
	            <div class="form-group required {{($errors->has('floor_number')) ? 'has-error' : ''}}" v-if="CategorySelected == '2'">
	              <label class="control-label"> No Lantai</label>
	              <input type="text" name="floor_number" value="{{ old('floor_number') }}" placeholder="" required class="form-control">
	              @if ($errors->has('floor_number'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('floor_number') }}</div></div>
                  @endif
	            </div>
	            <div class="form-group required {{($errors->has('parking_amount')) ? 'has-error' : ''}}" v-if="CategorySelected == '4'">
	              <label class="control-label"> Jumlah Parkir</label>
	              <input type="number" min="0" name="parking_amount" value="{{ old('parking_amount') }}" placeholder="" required class="form-control">
	              @if ($errors->has('parking_amount'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('parking_amount') }}</div></div>
                  @endif
	            </div>

	            <div class="form-group {{($errors->has('colisting')) ? 'has-error' : ''}}">
                  <label for="in-7" class="control-label">Co-Listing</label>
                  <select id="in-7" required class="form-control" name="colisting">
                  	<option></option>
                  	@foreach($agents as $agent)
                  	<option value="{{ $agent->id }}">{{ $agent->name }}</option>
                  	@endforeach
                  </select>
                  @if ($errors->has('colisting'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('colisting') }}</div></div>
                  @endif
                </div>
                
	            <div class="form-group required form-group--col-12 {{($errors->has('description')) ? 'has-error' : ''}}" style="display:grid;">
                  <label for="description" class="control-label">Deskripsi</label>
                  {{-- <textarea id="in-remark" name="description" class="form-control">{{ old('description') }}</textarea> --}}
                  <input type="hidden" name="description">
                  <div id="quil" style="height:100px">
                  	{!! old('description') !!}
                  </div>

                  @if ($errors->has('description'))
                  	<div class="help-block filled"><div class="parsley-required">{{ $errors->first('description') }}</div></div>
                  @endif
                </div>

	          </div>
	          <div class="row">
	            <button class="form__submit">Next</button>
	          </div>
	        </form>
	      </div>
	      <div id="Photo" role="tabpanel" class="tab-pane {{session('success') ? 'active' : ''}}">
	        <div class="listing--items listing--grid listing--photos">
	          <div class="listing__actions">
	            <div class="listing__actions-border"></div>
	            <button type="button" data-toggle="modal" data-target="#modal-photos-uploader" class="btn--action js-listing-add-photo">Add new photo</button>
	          </div>
	          <div class="listing__list js-photos-list" style="min-height:580px;">
	          </div>
	          <div id="modal-photos-uploader" tabindex="-1" role="dialog" class="modal modal--photos-upload fade">
	            <div role="document" class="modal-dialog">
	              <div class="modal-content">
	                <div class="modal-header">
	                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
	                </div>
	                <div class="modal-body">
	                  <form id="photos-uploader" action="{{route('listings.property.images.store')}}" class="dropzone">
	                  	@csrf
	                  	@method('PUT')
	                  </form>
	                </div>
	                <div class="modal-footer">
	                  <button type="button" class="btn--primary" onclick="window.location.href='{{route('listings.property.index')}}';">Save changes</button>
	                  <button type="button" data-dismiss="modal" class="btn--default">Cancel</button>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div id="modal-photos-edit" tabindex="-1" role="dialog" class="modal modal--photos-upload fade">
	            <div role="document" class="modal-dialog">
	              <div class="modal-content">
	                <div class="modal-header">
	                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
	                </div>
	                <div class="modal-body">
	                  <div class="tab tab--sidebar">
	                    <!-- Nav tabs-->
	                    <ul role="tablist" class="nav tab__nav">
	                      <li role="presentation" class="active"><a href="#crop" aria-controls="crop" role="tab" data-toggle="tab" id="tab-crop">Crop photo</a></li>
	                      <li role="presentation"><a href="#caption" aria-controls="caption" role="tab" data-toggle="tab" id="tab-caption">Add caption</a></li>
	                      <li role="presentation"><a href="#watermark" aria-controls="watermark" role="tab" data-toggle="tab" id="tab-watermark">Add watermark</a></li>
	                    </ul>
	                    <!-- Tab panes-->
	                    <div class="tab-content payment__content">
	                      <div id="crop" role="tabpanel" class="tab-pane active">
	                        <div class="photo-crop"><img id="photo-crop" src="{{url('assets/frontend/media-demo/properties/1168x550/09.jpg')}}" alt=""></div>
	                      </div>
	                      <div id="caption" role="tabpanel" class="tab-pane">
	                        <form class="form form--flex form--property form--photo js-form-property"><img src="{{url('assets/frontend/media-demo/properties/1168x550/09.jpg')}}" alt="">
	                          <div class="row">
	                            <div class="form-group form-group--col-12">
	                              <label for="in-Caption" class="control-label">Caption</label>
	                              <input id="in-Caption" type="text" placeholder="" class="form-control">
	                            </div>
	                          </div>
	                        </form>
	                      </div>
	                      <div id="watermark" role="tabpanel" class="tab-pane">
	                        <form class="form form--flex form--property form--photo js-form-property"><img src="{{url('assets/frontend/media-demo/properties/1168x550/09.jpg')}}" alt="">
	                          <div class="listing--items listing--grid listing--watermarks">
	                            <div class="listing__list listing--lg-4 listing--xs-6">
	                              <div class="listing__item js-listing-item">
	                                <div class="listing__thumb">
	                                  <button type="button" class="listing__select js-listing-select"></button><img src="{{url('assets/frontend/img/watermarks/watermark-1.png')}}" alt="">
	                                </div>
	                              </div>
	                              <div class="listing__item js-listing-item">
	                                <div class="listing__thumb">
	                                  <button type="button" class="listing__select js-listing-select"></button><img src="{{url('assets/frontend/img/watermarks/watermark-2.png')}}" alt="">
	                                </div>
	                              </div>
	                              <div class="listing__item js-listing-item">
	                                <div class="listing__thumb">
	                                  <button type="button" class="listing__select js-listing-select"></button><img src="{{url('assets/frontend/img/watermarks/watermark-3.png')}}" alt="">
	                                </div>
	                              </div>
	                              <div class="listing__item js-listing-item">
	                                <div class="listing__thumb">
	                                  <button type="button" class="listing__select js-listing-select"></button><img src="{{url('assets/frontend/img/watermarks/watermark-4.png')}}" alt="">
	                                </div>
	                              </div>
	                            </div>
	                          </div>
	                        </form>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	                <div class="modal-footer">
	                  <button type="button" class="btn--primary">Save changes</button>
	                  <button type="button" data-dismiss="modal" class="btn--default">Cancel</button>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	        <!-- END Photos-->
	        <form class="form form--flex form--property form--photo js-form-property">
	          <div class="row">
	            <button class="form__submit">Next</button>
	          </div>
	        </form>
	      </div>
	    </div>
	  </section>
	</div>
	</div>
@stop
@section('additional-styles')
<style type="text/css">
	.has-error .select2-selection {
    border-color: rgb(185, 74, 72) !important;
}
</style>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@endsection


@section('additional-scripts')
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>
<script type="text/javascript">

Vue.component('select2', { //city
  props: ['options','value'],
  template: "<select><slot></slot></select>",
  mounted: function () {
    var vm = this
    $(this.$el)
      // init select2
      .select2({ data: this.options })
      .val(this.value)
      .trigger('change')
      // emit event on change.
      .on('change', function () {
        vm.$emit('input', this.value)
      })
  },
  watch: {
    value: function (value) {
      // update value
      $(this.$el)
      	.val(value)
      	.trigger('change')
    },
    options: function (options) {
      // update options
      $(this.$el).empty().select2({ data: this.options }).val('{{ old('cities') }}').trigger('change');
    }
  },
  destroyed: function () {
    $(this.$el).off().select2('destroy')
  }
});

Vue.component('select3', { //province
  props: ['options','value'],
  template: "<select><slot></slot></select>",
  mounted: function () {
    var vm = this
    $(this.$el)
      // init select2
      .select2({ data: this.options })
      .val('')
      .trigger('change')
      // emit event on change.
      .on('change', function () {
        vm.$emit('input', this.value)
      })
      .css('width','100%')
  },
  watch: {
    value: function (value) {
      // update value
      $(this.$el)
        .val(value)
        .trigger('change')
    },
    options: function (options) {
      // update options
      $(this.$el).empty().select2({ data: this.options }).val('{{is_null(old('provinces'))?11:old('provinces')}}').trigger('change')
    }
  },
  destroyed: function () {
    $(this.$el).off().select2('destroy')
  }
});

var quileditor;

  var form = new Vue({
    el: '#form-add-property',
    data: {
      	CategorySelected:'{{(old('property_type')) ? : 1}}',
      	Price:'',
	  	DP:'',
	  	subdistrictOld:{{ old('subdistrict')? "`".old('subdistrict')."`" :'null' }},
	  	citySelected:'{{ old('cities') }}',
  	    options: [], //this is for cities
		oplist:[], //this if districts
      	provinceSelected:'{{ (is_null(old('provinces'))==true)?11:old('provinces') }}',
      	provinces_options:[]
    },
    created(){
	    this.fetchProvincesData();
    	this.fetchCitiesData(this.provinceSelected);
    	if(this.citySelected!=""){
    		this.fetchDistrictData(this.citySelected);
    	}
    	// 
    },
    methods: {
    	formatPrice(value) {
				let val = (value/1).toFixed(0).replace('.', ',')
				return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			},
		genPrice(){
			var trimPrice = (this.Price).split('.').join('');
			var fixPrice = this.formatPrice( trimPrice );
			this.Price = fixPrice;
		},
		isNumber: function(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46 && charCode !== 37 && charCode !== 39) {
				evt.preventDefault();;
			} else {
				return true;
			}
		},
		genDP(){
			var trimDP = (this.DP).split('.').join('');
			var fixDP = this.formatPrice( trimDP );
			this.DP = fixDP;
		},
		fetchProvincesData(){
		    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
		    axios.get('{{ Route('listings.property.add') }}?ajax=1').then(response => {
		        this.provinces_options = response.data;
		        this.finish = true;
		        });        
		},
		fetchCitiesData(province_id){
	        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
	        axios.get('{{ Route('listings.property.add') }}?province_id='+province_id+'&ajax=1').then(response => {
	            this.options = response.data;
	            this.finish = true;
	            });
		},
		fetchDistrictData(city_id){
	        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
	        axios.get('{{ Route('listings.property.add') }}?city_id='+city_id+'&ajax=1').then(response => {
	        	this.oplist = [];
	            this.oplist=(response.data);
	        	this.oplist.unshift({id:"",text:""});
	            this.finish = true;
	            });
		},
      insertDesc(){
        document.querySelector('input[name=description]').value=quileditor.root.innerHTML;
        
        return true;
      }
    },
    watch:{
		provinceSelected: function(){
			var province_id = this.provinceSelected;
			this.fetchCitiesData(province_id);
			this.oplist=[];
		},
    	citySelected :function(){
    		var city_id = this.citySelected;
    		if(city_id!="")
    		 {this.fetchDistrictData(city_id);}
    	},
    	oplist:function(){
    		if(this.oplist.length==0||this.citySelected==""){
    			$("#in-6").empty().select2({placeholder:"Pilih Kota terlebih dahulu!",data:[]}).prop('disabled',true).trigger('change');
    		}
    		else{
    		$("#in-6").empty().select2({placeholder:"Pilih Kecamatan...",data:this.oplist}).prop('disabled',false).val(this.subdistrictOld).trigger('change');
    		}
       	}
    }
  });

  quileditor = new Quill("#quil",{
    theme:'snow'
  });

  	// var $inWidgetsSelect = $('.widget select');
   //  if ($inWidgetsSelect.length) $inWidgetsSelect.select2({width: '100%',minimumResultsForSearch: Infinity});
    $("#in-6").select2({
      width: '100%',
      placeholder:"Pilih Kota terlebih dahulu!",
      matcher: function(params,data){
            if ($.trim(params.term) === '') {
              return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
              return null;
            }

            key = (params.term).split(" ");

            for (var i=0 ; i<key.length;++i){
                if (((data.text).toUpperCase()).indexOf((key[i]).toUpperCase()) == -1) 
                return null;
            }

            return data;
      },
    }).prop('disabled',true);

    $("#in-7").select2({
      width: '100%',
      allowClear:true,
      placeholder:"Pilihlah Co-Listing anda..",
      matcher: function(params,data){
            if ($.trim(params.term) === '') {
              return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
              return null;
            }

            key = (params.term).split(" ");

            for (var i=0 ; i<key.length;++i){
                if (((data.text).toUpperCase()).indexOf((key[i]).toUpperCase()) == -1) 
                return null;
            }

            return data;
      }
    });
</script>
@stop