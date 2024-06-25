import type {Image} from "~/models/Image";
import type {Category} from "~/models/Category";

export interface Product {
    id: number;
    category_id: number;
    uuid: string;
    title: string;
    price: number;
    description: string;
    metadata?: {
        image?: string;
        brand?: string;
    };
    created_at: string;
    updated_at: string;
    deleted_at: string | null;
    image?: Image;
    category: Category;
}

export type Products = Product[];
