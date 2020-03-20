<script>
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
  name: 'App',

  components: {
	ValidationObserver,
  	ValidationProvider
  },

  data () {
    return {
    	csrf_token: window.csrf_token,
    	loading: {
    		states: true,
    		cities: false,
    		channels: true
    	},
    	loaded: {
    		states: false,
    		cities: false,
    		channels: false,
    		state: null,
    	},
    	states: [],
    	cities: [],
    	channels: [],
    	form: {
    		state: '',
    		city: '',
    		name: '',
    		link: ''
    	}
    }
  },

  methods: {
  	async populateStates () {
  		this.loading.states = true;

  		try {
  			const response = await axios.get('/api/states')
  			this.states = response.data

  			this.loading.states = false;
  			this.loaded.states = true;
  		} catch (e) {
  			console.error(e);
  			this.loading.states = false;
  		}
  	},

  	async populateCities () {
	  	if (this.form.state.length === 0) {
	  		return
	  	}

  		this.loading.cities = true;

  		if (this.loaded.state === this.form.state) {
  			return;
  		}

  		try {
  			const response = await axios.get(`/api/states/${this.form.state}/cities`)
  			this.cities = response.data
  			
  			this.loading.cities = false;
  			this.loaded.cities = true;
  			this.loaded.state = this.form.state;
  		} catch (e) {
  			console.error(e);
  			this.loading.cities = false;
  		}
  	},

  	async populateTable(){
  		this.loading.channels = true;

  		try {
  			const response = await axios.get(`/api/channels`)
  			this.channels = response.data
  			
  			this.loading.channels = false;
  			this.loaded.channels = true;
  		} catch (e) {
  			console.error(e);
  			this.loading.channels = false;
  		}
  	}
  },

  mounted () {
  	this.populateStates();
  	this.populateTable();
  }
}
</script>

<template>
	<div class="container">
		<div class="section">
			<ValidationObserver tag="form" v-slot="{ invalid }">
				<form action="/channels" method="post">
					<input type="hidden" name="_token" :value="csrf_token">
					<div class="columns">
						<div class="column">
							<ValidationProvider name="Estado" rules="required" v-slot="{ errors }">
								<div class="field">
									<div class="control">
										<label class="label" for="">Estado</label>
										
										<div class="select is-fullwidth" :class="{'is-loading' : loading.states}">
										  <select name="state" v-model="form.state" @change="populateCities">
										    <option value="">Estado</option>
										    <option v-for="state in states" :key="state.id" :value="state.id">{{ state.name }}</option>
										  </select>
										</div>
									</div>
									<p class="help is-danger">{{ errors[0] }}</p>
								</div>
							</ValidationProvider>
						</div>

						<div class="column">
							<ValidationProvider name="Cidade" rules="required" v-slot="{ errors }">
								<div class="field">
									<div class="control">
										<label class="label" for="">Cidade</label>
										
										<div class="select is-fullwidth" :disabled="!loaded.cities" :class="{'is-loading' : loading.cities}">
										  <select name="city" v-model="form.city">
										    <option value="">Cidade</option>
										    <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
										  </select>
										</div>
									</div>
									<p class="help is-danger">{{ errors[0] }}</p>
								</div>
							</ValidationProvider>
						</div>

						<div class="column">
							<ValidationProvider name="Link do canal" rules="required|url" v-slot="{ errors }" >
								<div class="field">
									<div class="control">
										<label class="label" for="">Link do canal</label>
										
										<input type="text" class="input" name="link" v-model="form.link" />
									</div>
									<p class="help is-danger">{{ errors[0] }}</p>
								</div>
							</ValidationProvider>
						</div>
					</div>

					<div class="field">
						<button :disabled="invalid" class="button is-large is-success">Cadastrar</button>
					</div>
				</form>
			</ValidationObserver>
		</div>

		<div class="section">
			<progress v-show="!loaded.channels && loading.channels" class="progress is-small is-primary" max="100">15%</progress>

			<div class="content" v-show="loaded.channels && !loading.channels && channels.length > 0">
			
				<table class="table is-fullwidth is-bordered is-striped is-hoverable">
					<thead>
						<tr>
							<th>#</th>
							<th>Estado</th>
							<th>Cidade</th>
							<th>Link</th>
						</tr>
					</thead>

					<tbody>
						<tr v-for="(channel, index) in channels" :key="channel.id">
							<td>{{ index + 1 }}</td>
							<td>{{ channel.state }}</td>
							<td>{{ channel.city }}</td>
							<td>
								<a :href="channel.youtube_url">{{ channel.youtube_url }}</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<style lang="css" scoped>
</style>
