<template>
  <q-page class="flex flex-center">
    <div class="contenedorTar">
      <div class="columna">
          <q-card class="my-card tarjeta bg-teal-12" v-for="(item, key) in english" :key="key" :id="'e'+ key" @click="seleccionar(key,'e')">
          <q-card-section>
            <div class="text-h6">{{item.word}}</div>
          </q-card-section>
        </q-card>
      </div>

      <div class="columna">
        <q-card class="my-card tarjeta bg-teal-12" v-for="(item, key) in spanish"  :key="key" :id="'s'+ key" @click="seleccionar(key,'s')">
          <q-card-section>
            <div class="text-h6">{{item.word}}</div>
          </q-card-section>
        </q-card>
      </div>

    </div>
  </q-page>
</template>

<script>
export default {
  name: 'Home',
  components: {

  },
  data: () => ({
    info: [],
    spanish: [],
    english: [],
    enselect: '',
    spselect: ''
  }),
  methods: {
    seleccionar(id, idioma){
      this.quitarSelect(idioma)
      var el = document.getElementById(idioma+id)
      el.classList.add("seleccionado");
      if(idioma == 'e'){
        this.enselect = id
      }else{
        this.spselect = id
      }
    },
    quitarSelect(idioma){
      for(var i = 0; i<7; i++ ){
        var el = document.getElementById(idioma+i)
        el.classList.remove("seleccionado")
      }
    }
  },
  created(){
    fetch("http://smgpuntosdeventa.net/palabras/")
    .then(response => response.json())
    .then(data => {
      console.log(data)
      this.info = data.palabras
      this.info.forEach( (e,i) => {
        this.spanish.push({indice: i, word: e.spanish})
        this.english.push({indice: i, word:e.english})
      })
      this.spanish.sort(() => Math.random() - 0.5)
      this.english.sort(() => Math.random() - 0.5)
    })


  }

}
</script>
<style scoped>
  .contenedorTar{
    display: flex;
    width: 80%;
    justify-content: space-between;
  }
  .tarjeta{
    margin: 10px 0px;
    width: 40%;
    border-radius: 5px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    background: linear-gradient(to bottom, #f8f8f8, #e8e8e8);
    border: 1px solid #ccc;
  }
  .tarjeta:hover{
    transform: translateY(-2px);
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);

  }
  .columna{
    width: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .seleccionado{
    border: 1px solid rgb(11, 9, 165);
    transform: translateY(-2px);
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
  }

  .inactiva, .inactiva:hover {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
  box-shadow: none;
}

</style>
