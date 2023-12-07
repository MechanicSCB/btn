<script setup>
import {provide, ref} from "vue";
import CreateModal from "@/Pages/Products/Partials/CreateModal.vue";

let props = defineProps({products: Array});
let showCreateModal = ref(false);

provide('showCreateModal', showCreateModal);
</script>
<template>
    <div>
        <CreateModal v-if="showCreateModal"/>

        <div class="absolute top-16 right-2 py-2 px-10 rounded-md text-white bg-[#0FC5FF] hover:bg-sky-600 text-xs cursor-pointer"
             @click="showCreateModal=true"
        >Добавить</div>

        <div class="w-fit text-gray-500">
            <!-- field names -->
            <div class="py-2 px-6 grid grid-cols-4 uppercase">
                <span class="">Артикул</span>
                <span class="">Название</span>
                <span class="">Статус</span>
                <span class="">Атрибуты</span>
            </div>

            <div class="bg-white">
                <div class="py-3 px-6 border-b grid grid-cols-4" :key="product.id" v-for="product in products">
                    <span>{{ product.article }}</span>
                    <span>{{ product.name }}</span>
                    <span>{{ product.status }}</span>
                    <div class="max-w-[150px] flex flex-col">
                        <span v-for="item in product.data">{{ item.field }}: {{ item.value }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
