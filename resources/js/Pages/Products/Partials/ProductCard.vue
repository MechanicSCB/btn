<script setup>
import {inject} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {router} from "@inertiajs/vue3";
import TrashIcon from "@/Svg/TrashIcon.vue";
import PencilIcon from "@/Svg/PencilIcon.vue";

let props = defineProps({product: Object});
let showedProductId = inject('showedProductId');
let editedProductId = inject('editedProductId');

let deleteProduct = () => {
    if (confirm('Вы действительно хотите удалить продукт: ' + props.product.name + '?')) {
        router.delete(route('products.destroy', props.product.id));
    }

    showedProductId.value = null;
}
</script>
<template>
    <div v-if="showedProductId!==null" @click="showedProductId=null"
         class="fixed z-10 left-0 top-0 w-full h-screen py-20 px-4 bg-[rgba(0,0,0,0.7)] flex items-center justify-center cursor-pointer"
    >
        <div @click.stop class="relative w-full max-w-[750px] max-h-screen min-h-[400px] text-white bg-[#374050] py-5 px-3 cursor-default overflow-y-auto">
            <!-- Close Modal List Button -->
            <div class="absolute top-4 right-1 flex items-center">
                <PencilIcon @click="showedProductId=null;editedProductId=product.id" class="p-1 w-5 h-5 bg-gray-900 cursor-pointer fill-gray-400 hover:fill-yellow-500"/>
                <TrashIcon @click="deleteProduct" class="ml-0.5 p-1 w-5 h-5 bg-gray-900 cursor-pointer fill-gray-400 hover:fill-red-500"/>
                <CloseCross @click="showedProductId=null" class="ml-2 w-8 cursor-pointer text-gray-400"/>
            </div>

            <h2 class="text-xl font-semibold mb-5">{{ product.name }}</h2>

            <div class="flex flex-col text-xs gap-3">
                <div class="flex"><span class="text-gray-300 w-[75px]">Артикул</span><span>{{ product.article }}</span></div>
                <div class="flex"><span class="text-gray-300 w-[75px]">Название</span><span>{{ product.name }}</span></div>
                <div class="flex"><span class="text-gray-300 w-[75px]">Статус</span><span>{{ product.status }}</span></div>
                <div class="flex">
                    <span class="text-gray-300 w-[75px]">Атрибуты</span>
                    <div class="flex flex-col">
                        <span v-for="item in product.data">{{ item.field }}: {{ item.value }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
