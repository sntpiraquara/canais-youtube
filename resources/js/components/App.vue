<script>
import ChannelForm from "./ChannelForm"

export default {
  name: 'App',

  components: {
  	ChannelForm
  },

  data () {
    return {
    	cadastro: false,
    	loading: {
    		channels: true
    	},
    	loaded: {
    		channels: false,
    	},
    	channels: []
    }
  },

  methods: {
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
  	this.populateTable();
  	this.cadastro = window.cadastro
  }
}
</script>

<template>
	<div class="container">
		<div class="section">
			<ChannelForm v-if="cadastro" />
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
