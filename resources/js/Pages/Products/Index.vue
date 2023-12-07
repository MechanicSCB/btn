<script setup>
import {provide, ref} from "vue";
import ProductCard from "@/Pages/Products/Partials/ProductCard.vue";
import EditProductCard from "@/Pages/Products/Partials/EditProductCard.vue";

let props = defineProps({products: Array});
let showCreateModal = ref(false);
let showedProductId = ref(null);
let editedProductId = ref(null);

provide('showCreateModal', showCreateModal);
provide('showedProductId', showedProductId);
provide('editedProductId', editedProductId);
</script>
<template>
    <div>
        <EditProductCard v-if="editedProductId!==null || showCreateModal" :product="products[editedProductId]"/>
        <ProductCard v-if="showedProductId!==null" :product="products[showedProductId]"/>

        <div v-if="$page.props.auth.user" class="absolute z-10 top-16 right-2 py-2 px-10 rounded-md text-white bg-[#0FC5FF] hover:bg-sky-600 text-xs cursor-pointer"
             @click="showCreateModal=true"
        >Добавить</div>

        <div class="w-fit text-gray-500 pb-16">
            <!-- field names -->
            <div class="w-full bg-gray-100 py-2 px-6 grid grid-cols-4 uppercase gap-2">
                <span class="">Артикул</span>
                <span class="">Название</span>
                <span class="">Статус</span>
                <span class="">Атрибуты</span>
            </div>

            <div class="bg-white">
                <div @click="showedProductId=product.id" class="py-3 px-6 border-b grid grid-cols-4 hover:bg-gray-300 cursor-pointer gap-2" :key="product.id" v-for="product in products">
                    <span class="">{{ product.article }}</span>
                    <span class="max-w-[270px]">{{ product.name }}</span>
                    <span>{{ product.status==='available' ? 'Доступен' : 'Не доступен' }}</span>
                    <div class="max-w-[150px] flex flex-col">
                        <span v-for="item in product.data">{{ item.field }}: {{ item.value }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
