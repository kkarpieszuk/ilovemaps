import { registerBlockType } from '@wordpress/blocks';

const style = {
    'width': '100%',
    'height': '500px',
    'backgroundColor': 'grey'
};

// hack to fire "onload" when block is loaded
// https://wordpress.stackexchange.com/questions/331774/load-script-after-block-is-inserted

registerBlockType( 'ilovemaps/simple', {
    title: 'Simple Map',
    icon: 'location-alt',
    category: 'layout',
    edit: () => <div id={'mapCanvas'} style={style}>
        <img
            className="onload-hack-pp"
            height="0"
            width="0"
            onLoad={ onSimpleMapBlockLoad }
            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1' %3E%3Cpath d=''/%3E%3C/svg%3E"
        />
    </div>,
    save: () => <div id={'mapCanvas'} style={style}>This is map placeholder</div>,
} );