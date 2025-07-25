<template>
  <DropdownMenu>
    <DropdownMenuTrigger>
      <slot name="trigger" />
    </DropdownMenuTrigger>
    <DropdownMenuContent :align="align" :class="contentClass">
      <slot name="content" />
    </DropdownMenuContent>
  </DropdownMenu>
</template>

<script setup lang="ts">
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

interface Props {
  align?: 'start' | 'end' | 'center'
  width?: string
}

const props = defineProps<Props>()

// Convert width prop to CSS class for compatibility
const contentClass = props.width ? `w-${props.width}` : ''
</script>
