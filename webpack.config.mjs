import path from 'path';
import {fileURLToPath} from 'url';
import webpack from 'webpack';
import {WebpackManifestPlugin} from 'webpack-manifest-plugin';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

export default {
	context: path.resolve(__dirname),
	entry: './src/Application/UI/client/index.js',
	output: {
		path: path.resolve(__dirname, 'public/dist'),
		publicPath: '/dist/',
	},
	module: {
		rules: [
			{
				test: /\.css$/,
				use: [
					'style-loader',
					'css-loader',
				],
			},
		],
	},
	plugins: [
		new WebpackManifestPlugin(),
		new webpack.EnvironmentPlugin('NODE_ENV'),
	],
	devServer: {
		port: 3000,
		hot: true,
		static: {
			directory: path.resolve(__dirname, 'public/dist'),
		},
	},
};
